<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->integer('score_attendance')->default(0); // skor dari absensi
            $table->integer('score_test')->default(0); // skor dari ujian
            $table->integer('final_score')->default(0); // total skor
            $table->enum('recommendation', ['extend', 'terminate'])->nullable(); // keputusan sistem
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
};