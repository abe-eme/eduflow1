<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'course_id',
        'created_by',
        'title',
        'description',
        'file_path',
        'due_date'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function submissions()
{
    return $this->hasMany(Submission::class);
}

}
