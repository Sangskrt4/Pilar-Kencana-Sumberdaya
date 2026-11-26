<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom 'role' setelah kolom 'password'
            // Default-nya 'pelamar', nanti HRD bisa kita ubah
            $table->string('role')->default('pelamar')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom 'role' kalau migration di-rollback
            $table->dropColumn('role');
        });
    }
};