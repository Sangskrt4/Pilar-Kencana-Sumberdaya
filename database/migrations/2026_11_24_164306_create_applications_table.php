<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            // Relasi ke user (pelamar)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('job_vacancy_id')->constrained('job_vacancies')->onDelete('cascade');
            
            $table->string('full_name');
            $table->string('nik')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('cv_path')->nullable(); // lokasi file CV
            
            // Status tracking (default: submitted)
            $table->enum('status', ['submitted', 'screening', 'rejected', 'interview', 'accepted', 'training', 'graduated', 'failed'])->default('submitted');
            $table->text('rejection_reason')->nullable(); // alasan ditolak
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('applications');
    }
};