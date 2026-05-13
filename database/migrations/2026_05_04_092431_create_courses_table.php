<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('courses', function (Blueprint $table) {
        $table->id();

        $table->string('title');
        $table->text('description')->nullable();

        // teacher who created course
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        // course status (admin approval system)
        $table->string('status')->default('pending'); 
        // pending | approved | rejected

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
