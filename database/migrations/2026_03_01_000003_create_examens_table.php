<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('niveau_formation_id')->constrained('niveaux_formation')->onDelete('cascade');
            $table->string('titre', 150);
            $table->text('description')->nullable();
            $table->enum('type', ['ecrit', 'oral', 'pratique', 'mixte']);
            $table->decimal('note_maximale', 5, 2)->default(20.00);
            $table->decimal('note_passage', 5, 2)->default(10.00);
            $table->date('date_examen')->nullable();
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examens');
    }
};
