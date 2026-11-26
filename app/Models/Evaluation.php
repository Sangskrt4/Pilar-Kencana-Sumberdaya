<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id', 'score_attendance', 'score_test', 'final_score', 'recommendation'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}