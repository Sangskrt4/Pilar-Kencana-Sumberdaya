<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'division', 'description', 'requirements', 'prospects', 'quota', 'status'
    ];

    // Relasi: 1 Lowongan punya banyak Pendaftar
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}