<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'created_by'
    ];

    // relationship: quiz belongs to course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // relationship: quiz has many questions
    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }
}