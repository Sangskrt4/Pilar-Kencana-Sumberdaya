<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'job_vacancy_id', 'full_name', 'nik', 'phone', 
        'address', 'cv_path', 'status', 'rejection_reason'
    ];

    // Relasi ke User (Pelamar)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Lowongan
    public function jobVacancy()
    {
        return $this->belongsTo(JobVacancy::class);
    }

    // Relasi ke Log Status
    public function logs()
    {
        return $this->hasMany(ApplicationLog::class);
    }

    // Relasi ke Evaluasi
    public function evaluation()
    {
        return $this->hasOne(Evaluation::class);
    }
}