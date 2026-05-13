<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            // 🔥 each lesson belongs to a course
            $table->foreignId('course_id')
                ->constrained()
                ->onDelete('cascade');

            // lesson data
            $table->string('title');
            $table->text('content')->nullable();

            // ordering inside course
            $table->integer('order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};