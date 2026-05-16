<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Assignment;
use App\Models\Submission;

class CourseController extends Controller
{
    // teacher creates course
   public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
    ]);

    Course::create([
        'title' => $request->title,
        'description' => $request->description,

        // 🔥 THIS FIXES YOUR ERROR
        'teacher_id' => auth()->id(),
        'is_approved' => true,

        'status' => 'pending',
    ]);

    return redirect('/teacher/courses');
}

    // teacher courses list
    public function teacherIndex()
    {
        return Inertia::render('Teacher/Courses/Index', [
            'courses' => Course::where('teacher_id', auth()->id())->latest()->get()
        ]);
    }

    // approve
    public function approve(Course $course)
    {
        $course->update(['status' => 'approved']);
        return back();
    }

    // reject
    public function reject(Course $course)
    {
        $course->update(['status' => 'rejected']);
        return back();
    }

    // edit
    public function edit(Course $course)
    {
        return Inertia::render('Teacher/Courses/Edit', [
            'course' => $course
        ]);
    }

    // update
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable'
        ]);

        $course->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect('/teacher/courses');
    }

    // delete
    public function destroy(Course $course)
    {
        $course->delete();
          return redirect('/teacher/courses');
    }

    // suspend
    public function suspend(Course $course)
    {
        $course->update([
            'status' => 'suspended'
        ]);

        return back();
    }

  public function create()
{
    return Inertia::render('Teacher/Courses/Create');
}

    public function adminIndex()
    {
        return Inertia::render('Admin/Courses/Index', [
            'courses' => Course::with('teacher')->get()
        ]);
    }

   public function show(Course $course)
{
    return Inertia::render('Teacher/Courses/Show', [
        'course' => $course,

        // ✅ FIX 1: load lessons
        'lessons' => $course->lessons()->orderBy('lesson_order')->get(),

        // ✅ FIX 2: load assignments (THIS WAS MISSING)
        'assignments' => \App\Models\Assignment::where('course_id', $course->id)
            ->latest()
            ->get(),

        // (optional but useful later)
        'students' => \App\Models\Enrollment::with('user')
            ->where('course_id', $course->id)
            ->get()
            ->pluck('user')
    ]);
}

    // ✅ FIXED ENROLL ONLY (SINGLE VERSION)
 public function enroll(Course $course)
{
    \App\Models\Enrollment::firstOrCreate([
        'user_id' => auth()->id(),
        'course_id' => $course->id
    ]);

    return back();
}


public function studentCourse()
{
    $courses = Course::latest()->get();

    $courses->map(function ($course) {
        $course->is_enrolled = \App\Models\Enrollment::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->exists();

        return $course;
    });

    return Inertia::render('Student/Course/Index', [
        'courses' => $courses
    ]);
}
public function studentShow(Course $course)
{
    $isEnrolled = \App\Models\Enrollment::where('user_id', auth()->id())
        ->where('course_id', $course->id)
        ->exists();

    $lastLesson = null;

    $enrollment = \App\Models\Enrollment::where('user_id', auth()->id())
        ->where('course_id', $course->id)
        ->first();

    if ($enrollment && $enrollment->last_lesson_id) {
        $lastLesson = \App\Models\Lesson::find($enrollment->last_lesson_id);
    }

    return Inertia::render('Student/Course/Show', [
        'course' => $course,
        'lessons' => $course->lessons,
        'isEnrolled' => $isEnrolled,   // ✅ IMPORTANT FIX
        'lastLesson' => $lastLesson
    ]);
}
public function myCourses()
{
    $enrollments = Enrollment::with('course.user')
        ->where('user_id', auth()->id())
        ->get();

    return Inertia::render('Student/MyCourses/Index', [
        'enrollments' => $enrollments
    ]);
}


public function unenroll(Course $course)
{
    Enrollment::where('user_id', auth()->id())
        ->where('course_id', $course->id)
        ->delete();

    return back();
}


public function studentLesson(Course $course, Lesson $lesson)
{
    $userId = auth()->id();

    // check enrollment
    $enrolled = \App\Models\Enrollment::where('user_id', $userId)
        ->where('course_id', $course->id)
        ->exists();

    if (!$enrolled) {
        abort(403, 'You must enroll first');
    }

    // all lessons ordered
    $lessons = $course->lessons()
        ->orderBy('lesson_order')
        ->get();

    // completed lessons
    $completed = \App\Models\LessonProgress::where('user_id', $userId)
        ->pluck('lesson_id')
        ->toArray();

    // first lesson
    $firstLesson = $lessons->first();

    // previous lesson
    $previousLesson = $lessons
        ->where('lesson_order', '<', $lesson->lesson_order)
        ->sortByDesc('lesson_order')
        ->first();

    // CAN ACCESS RULE (FIXED LOGIC)
    $canAccess =
        $lesson->id === $firstLesson->id || // first lesson always open
        in_array($lesson->id, $completed) || // already completed
        ($previousLesson && in_array($previousLesson->id, $completed)); // previous done

    // next lesson
    $nextLesson = $lessons
        ->where('lesson_order', '>', $lesson->lesson_order)
        ->sortBy('lesson_order')
        ->first();

    return Inertia::render('Student/Lessons/Show', [
        'course' => $course,
        'lesson' => $lesson,
        'lessons' => $lessons,
        'nextLesson' => $nextLesson,
        'isCompleted' => in_array($lesson->id, $completed),
        'canAccess' => $canAccess,
    ]);
}
public function deleteAssignment($assignmentId)
{
    $assignment = Assignment::findOrFail($assignmentId);

    $courseId = $assignment->course_id;

    $assignment->delete();

    return redirect()->route('teacher.assignments.index', $courseId);
}
public function assignmentSubmissions($assignmentId)
{
    $assignment = Assignment::findOrFail($assignmentId);

    $submissions = Submission::with('user')
        ->where('assignment_id', $assignmentId)
        ->latest()
        ->get();

    return Inertia::render('Teacher/Assignments/Submissions', [
        'assignment' => $assignment,
        'submissions' => $submissions
    ]);
}
public function explore()
{
    $courses = Course::where('is_approved', true)
        ->latest()
        ->get();

    return Inertia::render('Student/Explore', [
        'courses' => $courses
    ]);
}
public function completeLesson(Lesson $lesson)
{
    $userId = auth()->id();

    // save progress
    \App\Models\LessonProgress::firstOrCreate([
        'user_id' => $userId,
        'lesson_id' => $lesson->id,
    ]);

    // update continue learning
    $enrollment = \App\Models\Enrollment::where('user_id', $userId)
        ->where('course_id', $lesson->course_id)
        ->first();

    if ($enrollment) {
        $enrollment->update([
            'last_lesson_id' => $lesson->id
        ]);
    }

    // get next lesson
    $nextLesson = \App\Models\Lesson::where('course_id', $lesson->course_id)
        ->where('lesson_order', '>', $lesson->lesson_order)
        ->orderBy('lesson_order')
        ->first();

    // auto go next lesson
    if ($nextLesson) {

        return redirect(
            "/student/courses/{$lesson->course_id}/lessons/{$nextLesson->id}"
        );
    }

    // course finished
    return redirect(
        "/student/courses/{$lesson->course_id}"
    )->with('success', 'Course completed!');
}
}