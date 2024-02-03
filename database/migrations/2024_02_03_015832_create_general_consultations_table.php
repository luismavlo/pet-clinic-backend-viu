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
        Schema::create('general_consultations', function (Blueprint $table) {
            $table->id();
            $table->string('blood_pressure');
            $table->string('reason');
            $table->integer('pet_id');
            $table->integer('schenduling_by');
            $table->integer('assigned_to');
            $table->integer('heart_rate');
            $table->string('observations');
            $table->integer('status');
            $table->integer('breathing_frequency');
            $table->integer('body_temperatura');
            $table->string('history_clinic_url');
            $table->integer('schedule_id');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_consultations');
    }
};
