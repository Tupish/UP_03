<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'teacher_id';
    protected $fillable = [];

    public function subjects(): hasMany{
        return $this->hasMany(Subject::class,'teacher_id');
    }
    public function user(): BelongsTo{
        return $this->belongsTo(User::class,'id');
    }
}
