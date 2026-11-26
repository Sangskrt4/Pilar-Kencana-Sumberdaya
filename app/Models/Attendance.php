<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id', 'training_id', 'attendance_date', 'check_in_time', 'status'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}