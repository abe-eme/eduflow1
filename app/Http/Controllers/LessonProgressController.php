<?php

namespace App\Http\Controllers;

use App\Models\LessonProgress;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonProgressController extends Controller
{
    public function complete(Lesson $lesson)
    {
        LessonProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'lesson_id' => $lesson->id,
            ],
            [
                'completed' => true,
                'completed_at' => now()
            ]
        );

        return back();
    }
}