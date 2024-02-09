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
           
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('appointment_duration');
            $table->string('start_hour');
            $table->integer('shift_duration');
            $table->string('end_hour');
            $table->integer('employee_id');
           
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
