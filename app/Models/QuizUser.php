<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'unique_id',
        'name',
        'email',
        'self_enroll',
        'self_or_else',
        'person_name',
        'person_father_name',
        'person_contact_no',
        'dob',
        'location',
        'gender',
    ];

    protected $casts = [
        'self_enroll' => 'boolean',
        'self_or_else' => 'boolean',
        'dob' => 'date',
    ];

    public function quizResults()
    {
        return $this->hasMany(QuizResult::class);
    }
}
