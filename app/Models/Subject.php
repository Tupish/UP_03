<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory,SoftDeletes;

    protected $primaryKey='subject_id';

    protected $fillable=['subject_name','teacher_id'];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class,'teacher_id');
    }
    public function mark(): HasMany
    {
        return $this->hasMany(Mark::class,'subject_id');
    }
    public function timetable(): HasMany
    {
        return $this->hasMany(Timetable::class,'subject_id');
    }
}
