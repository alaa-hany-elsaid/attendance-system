<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'title',
        'abstraction',
        'subject_id',
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function attendantStudents(): BelongsToMany
    {

        return $this->belongsToMany(User::class);
    }
}
