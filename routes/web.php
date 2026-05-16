<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Assignment;
use App\Models\Submission;

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\Admin\CourseBatchController;
use App\Http\Controllers\Student\BatchEnrollmentController;
use App\Http\Controllers\Student\LessonProgressController;



/*
|--------------------------------------------------------------------------
| PUBLIC PAGES (SPLASH / LANDING)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Inertia::render('Landing');
})->name('home');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Laravel Breeze / Fortify)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| AUTH MIDDLEWARE GROUP (CLEAN)
|--------------------------------------------------------------------------
*/



    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/dashboard', function () {

        return Inertia::render('Admin/Dashboard', [
            'totalUsers' => User::count(),
            'activeUsers' => User::where('status', 'active')->count(),
            'pendingUsers' => User::where('status', 'pending')->count(),
            'suspendedUsers' => User::where('status', 'suspended')->count(),
            'recentUsers' => User::latest()->take(5)->get(),
        ]);

    })->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | USERS
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/users', function () {

        return Inertia::render('Admin/Users/Index', [
            'users' => User::all()
        ]);

    })->name('admin.users.index');

    Route::get('/admin/users/create', function () {

        return Inertia::render('Admin/Users/Create');

    })->name('admin.users.create');

    Route::post('/admin/users', function (Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'active'
        ]);

        return redirect('/admin/users');

    })->name('admin.users.store');

    Route::post('/admin/users/{user}/toggle-status', function (User $user) {

        $user->status = $user->status === 'active'
            ? 'suspended'
            : 'active';

        $user->save();

        return back();

    })->name('admin.users.toggle-status');

    Route::get('/admin/users/{user}/edit', function (User $user) {

        return Inertia::render('Admin/Users/Edit', [
            'user' => $user
        ]);

    })->name('admin.users.edit');

    Route::put('/admin/users/{user}', function (User $user, Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/admin/users');

    })->name('admin.users.update');

    /*
    |--------------------------------------------------------------------------
    | COURSES
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/courses', [CourseController::class, 'adminIndex'])
        ->name('admin.courses.index');

    Route::post('/admin/courses/{course}/approve', [CourseController::class, 'approve'])
        ->name('admin.courses.approve');

    Route::post('/admin/courses/{course}/reject', [CourseController::class, 'reject'])
        ->name('admin.courses.reject');

    Route::post('/admin/courses/{course}/suspend', [CourseController::class, 'suspend'])
        ->name('admin.courses.suspend');

    /*
    |--------------------------------------------------------------------------
    | BATCHES (FIXED)
    |--------------------------------------------------------------------------
    */

/*
|--------------------------------------------------------------------------
| DELETE USER
|--------------------------------------------------------------------------
*/
Route::delete('/admin/users/{user}', function (User $user) {

    $user->delete();

    return redirect('/admin/users');

})->name('admin.users.destroy');

    /*
    |--------------------------------------------------------------------------
    | TEACHER DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/teacher/dashboard', function () {

        $userId = auth()->id();

        return Inertia::render('Teacher/Dashboard', [
            'totalCourses' => Course::where('user_id', $userId)->count(),
            'approvedCourses' => Course::where('user_id', $userId)->where('status', 'approved')->count(),
            'pendingCourses' => Course::where('user_id', $userId)->where('status', 'pending')->count(),
            'rejectedCourses' => Course::where('user_id', $userId)->where('status', 'rejected')->count(),
            'recentCourses' => Course::where('user_id', $userId)->latest()->take(5)->get()
        ]);

    })->name('teacher.dashboard');

    /*
    |--------------------------------------------------------------------------
    | COURSES
    |--------------------------------------------------------------------------
    */

    Route::get('/teacher/courses', [CourseController::class, 'teacherIndex']);
    Route::get('/teacher/courses/create', [CourseController::class, 'create']);
    Route::post('/teacher/courses', [CourseController::class, 'store']);

    Route::get('/teacher/courses/{course}', [CourseController::class, 'show'])
        ->name('teacher.courses.show');
        /*
|--------------------------------------------------------------------------
| EDIT COURSE
|--------------------------------------------------------------------------
*/

Route::get('/teacher/courses/{course}/edit',
    [CourseController::class, 'edit']
)->name('teacher.courses.edit');

/*
|--------------------------------------------------------------------------
| UPDATE COURSE
|--------------------------------------------------------------------------
*/

Route::put('/teacher/courses/{course}',
    [CourseController::class, 'update']
)->name('teacher.courses.update');

/*
|--------------------------------------------------------------------------
| DELETE COURSE
|--------------------------------------------------------------------------
*/

Route::delete('/teacher/courses/{course}',
    [CourseController::class, 'destroy']
)->name('teacher.courses.destroy');

    /*
    |--------------------------------------------------------------------------
    | LESSONS
    |--------------------------------------------------------------------------
    */

    Route::get('/teacher/courses/{course}/lessons', [LessonController::class, 'index'])
        ->name('teacher.lessons.index');

    Route::get('/teacher/courses/{course}/lessons/create', [LessonController::class, 'create'])
        ->name('teacher.lessons.create');

    Route::post('/teacher/courses/{course}/lessons', [LessonController::class, 'store']);

Route::patch('/lessons/{lesson}/toggle', [LessonController::class, 'togglePublish']);
Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | ASSIGNMENTS
    |--------------------------------------------------------------------------
    */

    Route::get('/teacher/courses/{course}/assignments', function ($courseId) {

        $course = Course::findOrFail($courseId);

        $assignments = Assignment::with('submissions.user')
            ->where('course_id', $courseId)
            ->latest()
            ->get();
            return Inertia::render('Teacher/Assignments/Index', [
            'course' => $course,
            'assignments' => $assignments,
            'course_id' => $courseId
        ]);

    })->name('teacher.assignments.index');

    Route::get('/teacher/courses/{course}/assignments/create', function ($courseId) {

        return Inertia::render('Teacher/Assignments/Create', [
            'course_id' => $courseId
        ]);

    })->name('teacher.assignments.create');

    Route::post('/teacher/courses/{course}/assignments', function ($courseId, Request $request) {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date'
        ]);

        Assignment::create([
            'course_id' => $courseId,
            'created_by' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date
        ]);

        return redirect()->route('teacher.assignments.index', $courseId);

    })->name('teacher.assignments.store');

    /*
    |--------------------------------------------------------------------------
    | ASSIGNMENT SUBMISSIONS
    |--------------------------------------------------------------------------
    */

    Route::get('/teacher/assignments/{assignment}/submissions', function ($assignmentId) {

        $assignment = Assignment::findOrFail($assignmentId);

        $submissions = Submission::with('user')
            ->where('assignment_id', $assignment->id)
            ->latest()
            ->get();

        return Inertia::render('Teacher/Assignments/Submissions', [
            'assignment' => $assignment,
            'submissions' => $submissions
        ]);

    })->name('teacher.assignments.submissions');

    /*
    |--------------------------------------------------------------------------
    | ASSIGNMENT EDIT / UPDATE / DELETE
    |--------------------------------------------------------------------------
    */

    Route::get('/teacher/assignments/{assignment}/edit', function ($assignment) {

        return Inertia::render('Teacher/Assignments/Edit', [
            'assignment' => Assignment::findOrFail($assignment)
        ]);

    })->name('teacher.assignments.edit');

    Route::put('/teacher/assignments/{assignment}', function ($assignment, Request $request) {

        $assignment = Assignment::findOrFail($assignment);

        $assignment->update($request->all());

        return redirect()->route('teacher.assignments.index', $assignment->course_id);

    })->name('teacher.assignments.update');

    Route::delete('/teacher/assignments/{assignment}', function ($assignment) {

        $assignment = Assignment::findOrFail($assignment);
        $courseId = $assignment->course_id;

        $assignment->delete();

        return redirect()->route('teacher.assignments.index', $courseId);

    })->name('teacher.assignments.destroy');
    Route::get('/teacher/courses/{course}/lessons', [LessonController::class, 'index'])
    ->name('teacher.lessons.index');

Route::get('/teacher/courses/{course}/lessons/create', [LessonController::class, 'create'])
    ->name('teacher.lessons.create');

Route::post('/teacher/courses/{course}/lessons', [LessonController::class, 'store'])
    ->name('teacher.lessons.store');

/* ✅ THIS WAS MISSING (CAUSE OF YOUR 404/ERROR) */
Route::get('/teacher/courses/{course}/lessons/{lesson}', [LessonController::class, 'show'])
    ->name('teacher.lessons.show');

Route::get('/teacher/courses/{course}/lessons/{lesson}/edit', [LessonController::class, 'edit'])
    ->name('teacher.lessons.edit');

Route::put('/teacher/courses/{course}/lessons/{lesson}', [LessonController::class, 'update'])
    ->name('teacher.lessons.update');

Route::delete('/teacher/courses/{course}/lessons/{lesson}', [LessonController::class, 'destroy'])
    ->name('teacher.lessons.destroy');


Route::post('/teacher/courses/{course}/quizzes', function ($courseId, Request $request) {

    $request->validate([
        'title' => 'required'
    ]);

    Quiz::create([
        'course_id' => $courseId,
        'title' => $request->title,
        'description' => $request->description,
        'created_by' => auth()->id()
    ]);

    return back();

})->name('teacher.quizzes.store');
Route::get('/teacher/courses/{course}/quizzes/create', function ($courseId) {

    $course = Course::findOrFail($courseId);

    return Inertia::render('Teacher/Quizzes/Create', [
        'course' => $course
    ]);

})->name('teacher.quizzes.create');
Route::get('/teacher/courses/{course}/quizzes', function ($courseId) {

    $course = \App\Models\Course::findOrFail($courseId);

    $quizzes = \App\Models\Quiz::where('course_id', $courseId)
        ->latest()
        ->get();

    return Inertia::render('Teacher/Quizzes/Index', [
        'course' => $course,
        'quizzes' => $quizzes
    ]);

})->name('teacher.quizzes.index');


        // LIST LESSONS
        Route::get('/courses/{course}/lessons', [LessonController::class, 'index'])
            ->name('teacher.lessons.index');

        // CREATE LESSON PAGE ⭐ IMPORTANT
        Route::get('/courses/{course}/lessons/create', [LessonController::class, 'create'])
            ->name('teacher.lessons.create');

        // STORE LESSON ⭐ IMPORTANT
        Route::post('/courses/{course}/lessons', [LessonController::class, 'store'])
            ->name('teacher.lessons.store');

        // SHOW LESSON
        Route::get('/courses/{course}/lessons/{lesson}', [LessonController::class, 'show'])
            ->name('teacher.lessons.show');

        // EDIT LESSON
        Route::get('/courses/{course}/lessons/{lesson}/edit', [LessonController::class, 'edit'])
            ->name('teacher.lessons.edit');

        // UPDATE LESSON
        Route::put('/courses/{course}/lessons/{lesson}', [LessonController::class, 'update'])
            ->name('teacher.lessons.update');

        // DELETE LESSON
        Route::delete('/courses/{course}/lessons/{lesson}', [LessonController::class, 'destroy'])
            ->name('teacher.lessons.destroy');
            Route::post('/lessons/{lesson}/complete', 
    [LessonProgressController::class, 'complete']
)->middleware('auth');
    

    /*
    |--------------------------------------------------------------------------
    | STUDENT
    |--------------------------------------------------------------------------
    */
/*
|--------------------------------------------------------------------------
| STUDENT ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/student/dashboard', function () {

        $user = auth()->user();

        $enrollments = Enrollment::with('course')
            ->where('user_id', $user->id)
            ->get();

        return Inertia::render('Student/Dashboard', [
            'enrollments' => $enrollments,
            'enrolledCourses' => $enrollments->count(),
        ]);

    })->name('student.dashboard');

    /*
    |--------------------------------------------------------------------------
    | EXPLORE COURSES
    |--------------------------------------------------------------------------
    */

    Route::get('/student/courses',
        [CourseController::class, 'studentCourses']
    )->name('student.courses');

    /*
    |--------------------------------------------------------------------------
    | COURSE DETAILS
    |--------------------------------------------------------------------------
    */

    Route::get('/student/courses/{course}',
        [CourseController::class, 'studentShow']
    )->name('student.courses.show');

    /*
    |--------------------------------------------------------------------------
    | MY COURSES
    |--------------------------------------------------------------------------
    */

    Route::get('/student/my-courses',
        [CourseController::class, 'myCourses']
    )->name('student.my-courses');

    /*
    |--------------------------------------------------------------------------
    | ENROLL
    |--------------------------------------------------------------------------
    */

    Route::post('/courses/{course}/enroll',
        [CourseController::class, 'enroll']
    )->name('courses.enroll');

    /*
    |--------------------------------------------------------------------------
    | UNENROLL
    |--------------------------------------------------------------------------
    */


Route::get('/student/explore', [CourseController::class, 'explore'])
    ->name('student.explore');
    Route::get('/student/courses', [CourseController::class, 'studentCourse'])
    ->name('student.courses.index');
    Route::get('/student/courses/{course}', [CourseController::class, 'studentShow'])
    ->name('student.courses.show');
    Route::post('/lessons/{lesson}/complete', [CourseController::class, 'completeLesson']);
   
    Route::delete('/courses/{course}/unenroll',
        [CourseController::class, 'unenroll']
    )->name('courses.unenroll');
    

    /*
    |--------------------------------------------------------------------------
    | LESSON VIEW
    |--------------------------------------------------------------------------
    */

    Route::get('/student/courses/{course}/lessons/{lesson}',
        [CourseController::class, 'studentLesson']
    )->name('student.lessons.show');


Route::middleware(['auth'])->group(function () {

    Route::get('/student/assignments/{assignment}', function ($assignment) {

        $assignment = Assignment::findOrFail($assignment);

        $submitted = Submission::where('assignment_id', $assignment->id)
            ->where('user_id', auth()->id())
            ->exists();

        return Inertia::render('Student/Assignments/Show', [
            'assignment' => $assignment,
            'isSubmitted' => $submitted
        ]);

    })->name('student.assignments.show');

    Route::post('/student/assignments/{assignment}/submit', function ($assignment, Request $request) {

        $request->validate([
            'answer' => 'nullable|string',
            'file' => 'nullable|file|max:5120'
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('submissions', 'public');
        }

        Submission::updateOrCreate(
            [
                'assignment_id' => $assignment,
                'user_id' => auth()->id()
            ],
            [
                'answer' => $request->answer,
                'file' => $filePath,
                'status' => 'submitted'
            ]
        );

        return back();

    })->name('student.assignments.submit');

});
});
});

use App\Http\Controllers\Auth\InvitationController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Route for Admin to generate and send invite
Route::middleware(['auth', 'can:admin-only'])->group(function () {
    Route::post('/admin/invite-teacher', [InvitationController::class, 'sendInvite'])->name('admin.invite.teacher');
});

// The entry route handling the submitted registration form 
Route::post('/register', [RegisteredUserController::class, 'store']);