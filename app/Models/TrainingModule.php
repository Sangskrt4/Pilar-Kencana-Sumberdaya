<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingModule extends Model
{
    protected $fillable = [
        'division', 'order_number', 'title', 'summary', 'content', 'duration', 'quiz_questions'
    ];

    protected $casts = [
        'quiz_questions' => 'array',
    ];
}