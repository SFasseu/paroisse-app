<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progressions_catechumene', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catechumene_id')->constrained('catechumenes')->onDelete('cascade');
            $table->foreignId('niveau_formation_id')->constrained('niveaux_formation')->onDelete('cascade');
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->enum('statut', ['en_cours','termine','abandonne','en_attente'])->default('en_cours');
            $table->decimal('note_finale', 5, 2)->nullable();
            $table->boolean('valide')->default(false);
            $table->foreignId('valide_par')->nullable()->constrained('users')->nullOnDelete();
            $table->date('date_validation')->nullable();
            $table->text('commentaires')->nullable();
            $table->unique(['catechumene_id', 'niveau_formation_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progressions_catechumene');
    }
};
