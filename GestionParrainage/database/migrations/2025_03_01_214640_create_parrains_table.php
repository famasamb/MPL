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
        Schema::create('parrains', function (Blueprint $table) {
            $table->id();
            $table->string('numero_electeur')->unique();
            $table->string('cin')->unique();
            $table->string('nom');
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
        Schema::dropIfExists('parrains');
    }
};
