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
        Schema::create('marks', function (Blueprint $table) {
            $table->id('mark_id');
            $table->string('value');
            $table->string('control_type', 50);
            $table->date('date');
            $table->foreignId('teacher_id')->constrained('teachers', 'teacher_id');
            $table->foreignId('student_id')->constrained('students', 'student_id');
            $table->foreignId('subject_id')->constrained('subjects', 'subject_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
