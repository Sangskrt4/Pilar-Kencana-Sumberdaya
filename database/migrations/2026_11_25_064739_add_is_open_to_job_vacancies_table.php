<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('job_vacancies', function (Blueprint $table) {
            // Default false (belum dibuka)
            $table->boolean('is_open')->default(false); 
        });
    }

    public function down()
    {
        Schema::table('job_vacancies', function (Blueprint $table) {
            $table->dropColumn('is_open');
        });
    }
};