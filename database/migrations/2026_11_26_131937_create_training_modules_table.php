<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_modules', function (Blueprint $table) {
            $table->id();
            $table->string('division');
            $table->integer('order_number')->default(1);
            $table->string('title');
            $table->text('summary');
            $table->longText('content');
            $table->string('duration')->default('30 Menit');
            $table->json('quiz_questions')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_modules');
    }
};