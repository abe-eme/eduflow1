<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNABLE FIELDS
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'course_id',
        'title',
        'content',
        'type',
        'file_path',
        'vidio_url',
        'order'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP: LESSON BELONGS TO COURSE
    |--------------------------------------------------------------------------
    */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}