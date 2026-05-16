<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Controllers\LessonProgressController;

class LessonController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index(Course $course)
    {
        return Inertia::render('Teacher/Lessons/Index', [
            'course' => $course,
            'lessons' => $course->lessons()
                ->orderBy('lesson_order')
                ->get()
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */
    public function show(Course $course, Lesson $lesson)
    {
        abort_if($lesson->course_id !== $course->id, 404);

        $lessons = Lesson::where('course_id', $course->id)
            ->orderBy('lesson_order')
            ->get();

        return Inertia::render('Teacher/Lessons/Show', [
            'course' => $course,
            'lesson' => $lesson,
            'lessons' => $lessons
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create(Course $course)
    {
        return Inertia::render('Teacher/Lessons/Create', [
            'course' => $course
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
public function store(Request $request, Course $course)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'nullable|string',
        'type' => 'nullable|string|in:text,video,image',
        'lesson_order' => 'nullable|integer',
        'duration' => 'nullable|integer',
        'is_published' => 'nullable|boolean',
    ]);

    Lesson::create([
        'course_id' => $course->id,
        'title' => $request->title,
       'content' => $request->input('content', ''),
        'type' => $request->type ?? 'text',
        'lesson_order' => $request->lesson_order ?? 1,
        'duration' => $request->duration ?? 0,
        'is_published' => $request->is_published ?? 1,
    ]);

    return redirect()->back()->with('success', 'Lesson created successfully');
}
    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit(Course $course, Lesson $lesson)
    {
        abort_if($lesson->course_id !== $course->id, 404);

        return Inertia::render('Teacher/Lessons/Edit', [
            'course' => $course,
            'lesson' => $lesson
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE (FIXED)
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Course $course, Lesson $lesson)
    {
        abort_if($lesson->course_id !== $course->id, 404);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'type' => 'required|in:text,video,image',
            'lesson_order' => 'nullable|integer'
        ]);

        $lesson->update([
            'title' => $validated['title'],
            'content' => $validated['content'] ?? null,
            'type' => $validated['type'],
            'lesson_order' => $validated['lesson_order'] ?? 0
        ]);

        return redirect()->route('teacher.lessons.index', $course->id);
    }
    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy(Course $course, Lesson $lesson)
    {
        abort_if($lesson->course_id !== $course->id, 404);

        $lesson->delete();

        return redirect()->route('teacher.lessons.index', $course->id);
    }

    /*
    |--------------------------------------------------------------------------
    | TOGGLE PUBLISH
    |--------------------------------------------------------------------------
    */
    public function togglePublish(Lesson $lesson)
    {
        $lesson->is_published = !$lesson->is_published;
        $lesson->save();

        return back();
    }
  
}