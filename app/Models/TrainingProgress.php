<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingProgress extends Model
{
    protected $table = 'training_progress';

    protected $fillable = [
        'user_id', 'training_module_id', 'is_completed', 'quiz_score', 'completed_at'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
    ];
}