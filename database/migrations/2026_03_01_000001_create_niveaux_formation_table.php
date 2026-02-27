<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('niveaux_formation', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->text('description')->nullable();
            $table->integer('ordre');
            $table->integer('duree_mois');
            $table->integer('age_minimum')->nullable();
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('niveaux_formation');
    }
};
