<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catechumenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('groupe_catechese_id')->nullable()->constrained('groupes_catechese')->nullOnDelete();
            $table->string('numero_dossier', 50)->unique();
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->date('date_naissance');
            $table->string('lieu_naissance', 150)->nullable();
            $table->enum('sexe', ['M', 'F']);
            $table->string('nationalite', 100)->default('Camerounaise');
            $table->text('adresse')->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('religion_actuelle', 100)->nullable();
            $table->enum('statut_matrimonial', ['celibataire','marie','divorce','veuf'])->nullable();
            $table->string('profession', 150)->nullable();
            $table->date('date_inscription');
            $table->enum('statut', ['inscrit','en_cours','suspendu','diplome','abandonne'])->default('inscrit');
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catechumenes');
    }
};
