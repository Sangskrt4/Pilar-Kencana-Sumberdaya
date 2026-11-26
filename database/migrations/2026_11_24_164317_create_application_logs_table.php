<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('application_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->string('status'); // status saat itu
            $table->text('notes')->nullable(); // catatan HRD
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('application_logs');
    }
};