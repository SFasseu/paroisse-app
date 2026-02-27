<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('groupes_catechese', function (Blueprint $table) {
            $table->id();
            $table->foreignId('niveau_formation_id')->constrained('niveaux_formation')->onDelete('cascade');
            $table->string('nom', 100);
            $table->string('annee_pastorale', 10);
            $table->string('lieu_reunion', 150)->nullable();
            $table->enum('jour_reunion', ['lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche'])->nullable();
            $table->time('heure_reunion')->nullable();
            $table->integer('capacite_max')->nullable();
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groupes_catechese');
    }
};
