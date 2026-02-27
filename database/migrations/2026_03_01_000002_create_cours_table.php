<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('niveau_formation_id')->constrained('niveaux_formation')->onDelete('cascade');
            $table->string('titre', 150);
            $table->text('description')->nullable();
            $table->text('objectifs')->nullable();
            $table->decimal('duree_heures', 5, 2)->nullable();
            $table->integer('ordre');
            $table->text('materiel_requis')->nullable();
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cours');
    }
};
