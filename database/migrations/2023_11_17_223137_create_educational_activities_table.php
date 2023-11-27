<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('educational_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->string('type'); // Typ aktivity (přednáška, cvičení, atd.)
            $table->integer('duration');
            $table->string('repetition'); // Opakování (každý, sudý, lichý týden, jednorázově)
            $table->date('event_date')->nullable();

            $table->unsignedBigInteger('room_id')->nullable(); // ID miestnosti, môže byť null
            $table->unsignedBigInteger('teacher_id')->nullable(); // ID vyučujúceho, môže byť null
            $table->json('preferred_day_time')->nullable(); // JSON pole pre vyhovujúce dni a pre vyhovujúce časy

            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_activities');
    }
};
