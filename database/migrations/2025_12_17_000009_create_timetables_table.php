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
        Schema::create('timetables', function (Blueprint $table) {
            $table->id('timetable_id');
            $table->integer('day_number');
            $table->integer('lesson_number');
            $table->string('room');
            $table->foreignId('group_id')->constrained('groups','group_id');
            $table->foreignId('subject_id')->constrained('subjects','subject_id');
            $table->foreignId('teacher_id')->constrained('teachers','teacher_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};
