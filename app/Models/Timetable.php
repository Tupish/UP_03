<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timetable extends Model
{
    /** @use HasFactory<\Database\Factories\TimetableFactory> */
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'timetable_id';
    protected $fillable = ['group_id','subject_id','teacher_id','day_number','lesson_number','room'];
}
