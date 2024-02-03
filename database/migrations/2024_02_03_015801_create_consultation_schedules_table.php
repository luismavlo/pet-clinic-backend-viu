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
        Schema::create('consultation_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('day_of_week');
            $table->date('start_time');
            $table->date('end_time');
            $table->string('appointment_duration');
            $table->string('month');
            $table->string('year');
            $table->boolean('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_schedules');
    }
};
