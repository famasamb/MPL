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
        Schema::create('electeurs_problemes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tentative_upload_id');
            $table->string('numero_carte_identite');
            $table->string('numero_electeur');
            $table->text('probleme');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electeurs_problemes');
    }
};
