<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mark extends Model
{
    /** @use HasFactory<\Database\Factories\MarkFactory> */
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'mark_id';
    protected $fillable = ['value','control_type','date','teacher_id','student_id','subject_id'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class,'student_id');
    }
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class,'teacher_id');
    }
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }

}
