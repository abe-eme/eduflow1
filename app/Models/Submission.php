<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'user_id',
        'answer',
        'score',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // Submission belongs to student
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Submission belongs to assignment
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}