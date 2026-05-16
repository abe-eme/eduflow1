<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'teacher_id',
        'is_approved'
    ];

    /*
    |--------------------------------------------------------------------------
    | TEACHER RELATION
    |--------------------------------------------------------------------------
    */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /*
    |--------------------------------------------------------------------------
    | LESSONS (FIXED - NO "order" ANYMORE)
    |--------------------------------------------------------------------------
    */
    public function lessons()
    {
        return $this->hasMany(Lesson::class)
            ->orderBy('lesson_order');
    }

    /*
    |--------------------------------------------------------------------------
    | ENROLLMENTS
    |--------------------------------------------------------------------------
    */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}