<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class etudiant extends Migration
{
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique()->nullable();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('telephone')->nullable();

            // Utilisation de foreignId + constrained() pour option_id
            $table->foreignId('option_id')->constrained('options')->onDelete('cascade');

            // Même chose pour niveau_id (table 'niveaux' attendue)
            $table->foreignId('niveau_id')->constrained('niveaux')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('etudiants');
    }
}
