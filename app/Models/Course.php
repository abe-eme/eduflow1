<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNABLE FIELDS
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP: COURSE BELONGS TO TEACHER
    |--------------------------------------------------------------------------
    */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP: COURSE HAS MANY LESSONS
    |--------------------------------------------------------------------------
    */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function enrollments()
{
    return $this->hasMany(Enrollment::class);
}
public function assignments()
{
    return $this->hasMany(Assignment::class);
}
}