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
            $table->foreignId('pet_id')->constrained('pets')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('schenduling_by')->constrained('employees')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('assigned_to')->constrained('employees')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('heart_rate');
            $table->string('observations');
            $table->integer('status');
            $table->integer('breathing_frequency');
            $table->integer('body_temperatura');
            $table->string('history_clinic_url');
            $table->date('appointment_date');
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
