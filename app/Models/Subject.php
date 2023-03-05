<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total_grade',
        'attendance_grade',
        'project_grade',
        'midterm_grade',
        'final_grade',
        'every_lecture_grade',
        'lectures_number',
        'user_id',
    ];


    public function professor(): BelongsTo
    {
//        dd($this->user_id);
        return $this->belongsTo(User::class , 'user_id');
    }


    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }


    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class);
    }

}
