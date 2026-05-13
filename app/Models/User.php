<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // Teacher → Courses they created
    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    // Student → Enrolled courses
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // Student → lesson progress tracking
    public function lessonProgress()
    {
        return $this->hasMany(LessonProgress::class);
    }

    // Student → submissions
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}