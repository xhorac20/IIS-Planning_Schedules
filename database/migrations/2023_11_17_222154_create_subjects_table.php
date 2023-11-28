<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Unikátní kód předmětu
            $table->string('name');
            $table->text('annotation')->nullable(); // Anotace předmětu
            $table->integer('credits');
            $table->unsignedBigInteger('guarantor_id')->nullable(); // ID garanta předmětu
            $table->json('teacher_ids')->nullable();   // Zoznam ID ucitelov predmetu

            $table->foreign('guarantor_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
