<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LessonController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (Show lessons for a course)
    |--------------------------------------------------------------------------
    */
    public function index(Course $course)
    {
        $lessons = Lesson::where('course_id', $course->id)
            ->orderBy('order')
            ->get();

        return Inertia::render('Teacher/Lessons/Index', [
            'course' => $course,
            'lessons' => $lessons
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */
    public function show(Course $course, Lesson $lesson)
{
    if ($lesson->course_id !== $course->id) {
        abort(404);
    }

    $lessons = Lesson::where('course_id', $course->id)
        ->orderBy('order')
        ->get();

    return Inertia::render('Teacher/Lessons/Show', [
        'course' => $course,
        'lesson' => $lesson,
        'lessons' => $lessons   // 🔥 THIS WAS MISSING
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'type' => 'required|in:text,video,image',
            'order' => 'nullable|integer'
        ]);

        Lesson::create([
            'course_id' => $course->id,
            'title' => $validated['title'],
            'content' => $validated['content'] ?? null,
            'type' => $validated['type'],
            'order' => $validated['order'] ?? 0
        ]);

        // ✅ FIXED: go back to LESSON TABLE (NOT course page)
        return redirect()->route('teacher.lessons.index', $course->id);
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit(Course $course, Lesson $lesson)
    {
        if ($lesson->course_id !== $course->id) {
            abort(404);
        }

        return Inertia::render('Teacher/Lessons/Edit', [
            'course' => $course,
            'lesson' => $lesson
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Course $course, Lesson $lesson)
    {
        if ($lesson->course_id !== $course->id) {
            abort(404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'type' => 'required|in:text,video,image',
            'order' => 'nullable|integer'
        ]);

        $lesson->update([
            'title' => $validated['title'],
            'content' => $validated['content'] ?? null,
            'type' => $validated['type'],
            'order' => $validated['order'] ?? 0
        ]);

        // ✅ FIXED: go back to LESSON TABLE (NOT course page)
        return redirect()->route('teacher.lessons.index', $course->id);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy(Course $course, Lesson $lesson)
    {
        if ($lesson->course_id !== $course->id) {
            abort(404);
        }

        $lesson->delete();

        // optional but consistent
        return redirect()->route('teacher.lessons.index', $course->id);
    }
}