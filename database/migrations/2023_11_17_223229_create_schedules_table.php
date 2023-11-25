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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('educational_activity_id');
            $table->unsignedBigInteger('room_id'); // ID místnosti
            $table->unsignedBigInteger('instructor_id'); // ID vyučujícího
            $table->string('day');  // Den aktivity
            $table->time('start_time'); // Začátek aktivit
            $table->time('end_time'); // Konec aktivit
            $table->foreign('educational_activity_id')->references('id')->on('educational_activities');
            $table->foreign('room_id')->references('id')->on('rooms'); // Předpokládá existenci tabulky místností
            $table->foreign('instructor_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
