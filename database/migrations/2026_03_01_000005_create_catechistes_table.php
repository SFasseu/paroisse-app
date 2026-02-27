<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catechistes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('telephone', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->date('date_naissance')->nullable();
            $table->date('date_engagement')->nullable();
            $table->string('specialite', 150)->nullable();
            $table->string('photo', 255)->nullable();
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catechistes');
    }
};
