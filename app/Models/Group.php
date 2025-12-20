<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    /** @use HasFactory<\Database\Factories\GroupFactory> */
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'group_id';

    protected $fillable = ['group_name'];

    public function student(): HasMany
    {
        return $this->hasMany(Student::class,'group_id');
    }
    public function timetable(): HasMany
    {
        return $this->hasMany(Timetable::class,'group_id');
    }
}
