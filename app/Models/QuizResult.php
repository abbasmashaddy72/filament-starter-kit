<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_user_id',
        'quiz_topic_id',
        'quiz_question_id',
        'quiz_option_id',
        'correct',
    ];

    protected $casts = [
        'correct' => 'boolean',
    ];

    public function quizUser()
    {
        return $this->belongsTo(QuizUser::class);
    }

    public function quizTopic()
    {
        return $this->belongsTo(QuizTopic::class);
    }

    public function quizQuestion()
    {
        return $this->belongsTo(QuizQuestion::class);
    }

    public function quizOption()
    {
        return $this->belongsTo(QuizOption::class);
    }
}
