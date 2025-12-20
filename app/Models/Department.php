<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'department_id';

    protected $fillable =['department_name'];

    public function student(): HasMany
    {
        return $this->hasMany(Student::class,'department_id');
    }
}
