<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'student_id';
    protected $fillable = ['first_name','last_name','group_id','department_id'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class,'group_id');
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class,'department_id');
    }
    public function mark(): HasMany{
        return $this->hasMany(Student::class,'student_id');
    }
    public function user(): BelongsTo{
        return $this->belongsTo(User::class,'user_id');
    }
}
