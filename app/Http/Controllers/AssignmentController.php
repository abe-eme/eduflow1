<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\Submission;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AssignmentController extends Controller
{
    /*
    |------------------------------------------
    | INDEX (LIST ASSIGNMENTS)
    |------------------------------------------
    */
    public function index($courseId)
    {
        $course = Course::findOrFail($courseId);

        $assignments = Assignment::with('submissions')
            ->where('course_id', $courseId)
            ->latest()
            ->get();

        return Inertia::render('Teacher/Assignments/Index', [
            'course' => $course,
            'assignments' => $assignments,
            'course_id' => $courseId
        ]);
    }

    /*
    |------------------------------------------
    | CREATE PAGE
    |------------------------------------------
    */
    public function create($courseId)
    {
        return Inertia::render('Teacher/Assignments/Create', [
            'course_id' => $courseId
        ]);
    }

    /*
    |------------------------------------------
    | STORE ASSIGNMENT
    |------------------------------------------
    */
    public function store(Request $request, $courseId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date'
        ]);

        Assignment::create([
            'course_id' => $courseId,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('teacher.assignments.index', $courseId);
    }

    /*
    |------------------------------------------
    | EDIT PAGE
    |------------------------------------------
    */
    public function edit($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);

        return Inertia::render('Teacher/Assignments/Edit', [
            'assignment' => $assignment
        ]);
    }

    /*
    |------------------------------------------
    | UPDATE ASSIGNMENT
    |------------------------------------------
    */
    public function update(Request $request, $assignmentId)
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

    /*
    |------------------------------------------
    | DELETE ASSIGNMENT
    |------------------------------------------
    */
    public function destroy($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);
        $courseId = $assignment->course_id;

        $assignment->delete();

        return redirect()->route('teacher.assignments.index', $courseId);
    }

    /*
    |------------------------------------------
    | SUBMISSIONS PAGE
    |------------------------------------------
    */
    public function submissions($assignmentId)
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