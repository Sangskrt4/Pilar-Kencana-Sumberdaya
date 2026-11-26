<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // contoh: Operator Alat Berat
            $table->string('division'); // contoh: Produksi, HRD
            $table->text('description'); // deskripsi kerja
            $table->text('requirements'); // syarat
            $table->text('prospects'); // prospek kerja
            $table->integer('quota')->default(1); // kuota
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_vacancies');
    }
};