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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();

           // $table->integer('client_id');
            $table->foreingId('client_id')->constrained('clients')->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('photo');
            $table->string('name');
            $table->date('birthdate');
            $table->string('race');
           // $table->integer('specie_id');
            $table->foreingId('specie_id')->constrained('species')->cascadeOnUpdate()->cascadeOnDelete();
         
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
