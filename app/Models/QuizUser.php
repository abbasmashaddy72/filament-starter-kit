<?php

namespace App\Models;

use Illuminate\Support\Str;
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
        'dob',
        'enrollment_type',
        'person_name',
        'person_father_name',
        'person_contact_no',
        'person_dob',
        'location',
        'gender',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->unique_id = Str::random(5);
            while (static::where('unique_id', $model->unique_id)->exists()) {
                $model->unique_id = Str::random(5);
            }
        });
    }

    public function quizResults()
    {
        return $this->hasMany(QuizResult::class);
    }
}
