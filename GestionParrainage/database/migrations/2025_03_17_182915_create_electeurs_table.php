<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_electeurs_table.php
    public function up()
    {
        Schema::create('electeurs', function (Blueprint $table) {
            $table->id();
            $table->string('numero_carte_identite')->unique();
            $table->string('numero_electeur')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('sexe');
            $table->string('bureau_vote');
            $table->string('telephone')->unique();
            $table->string('email')->unique();
            $table->string('code_authentification');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electeurs');
    }
};
