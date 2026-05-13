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
            'courses' => Course::with('user')->get()
        ]);
    }

   public function show(Course $course)
{
    return Inertia::render('Teacher/Courses/Show', [
        'course' => $course,

        // ✅ FIX 1: load lessons
        'lessons' => $course->lessons()->orderBy('order')->get(),

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
    Enrollment::firstOrCreate([
        'user_id' => auth()->id(),
        'course_id' => $course->id
    ]);

    return redirect()->back();
}

   public function studentCourses()
{
    $courses = Course::with('user')
        ->where('status', 'approved')
        ->latest()
        ->get();

    return Inertia::render('Student/Courses/Index', [
        'courses' => $courses
    ]);
}
public function studentShow(Course $course)
{
    $isEnrolled = \App\Models\Enrollment::where('user_id', auth()->id())
        ->where('course_id', $course->id)
        ->exists();

    return Inertia::render('Student/Courses/Show', [
        'course' => $course,
        'lessons' => $course->lessons,
        'assignments' => \App\Models\Assignment::where('course_id', $course->id)
            ->latest()
            ->get(),
        'isEnrolled' => $isEnrolled
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
    // 🔒 check enrollment
    $enrolled = Enrollment::where('user_id', auth()->id())
        ->where('course_id', $course->id)
        ->exists();

    if (!$enrolled) {
        abort(403, 'You are not enrolled');
    }

    // ensure lesson belongs to course
    if ($lesson->course_id !== $course->id) {
        abort(404);
    }

    $lessons = Lesson::where('course_id', $course->id)
        ->orderBy('order')
        ->get();

    return Inertia::render('Student/Lessons/Show', [
        'course' => $course,
        'lesson' => $lesson,
        'lessons' => $lessons
    ]);
}
public function editAssignment($assignmentId)
{
    $assignment = Assignment::findOrFail($assignmentId);

    return Inertia::render('Teacher/Assignments/Edit', [
        'assignment' => $assignment
    ]);
}
public function updateAssignment(Request $request, $assignmentId)
{
    $assignment = Assignment::findOrFail($assignmentId);

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'due_date' => 'nullable|date'
    ]);

    $assignment->update([
        'title' => $request->title,
        'description' => $request->description,
        'due_date' => $request->due_date
    ]);

    return redirect()->route('teacher.assignments.index', $assignment->course_id);
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
}