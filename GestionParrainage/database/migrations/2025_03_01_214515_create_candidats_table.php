<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('candidats', function (Blueprint $table) {
        $table->id();
        $table->string('numero_electeur')->unique();
        $table->string('nom');
        $table->string('prenom');
        $table->date('date_naissance');
        $table->string('email')->unique();
        $table->string('telephone')->unique();
        $table->string('parti_politique')->nullable();
        $table->string('slogan')->nullable();
        $table->string('photo')->nullable();
        $table->string('couleurs_parti')->nullable();
        $table->string('url_page')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidats');
    }
};
