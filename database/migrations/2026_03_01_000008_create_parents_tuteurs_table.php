<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parents_tuteurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('catechumene_id')->constrained('catechumenes')->onDelete('cascade');
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->enum('lien', ['pere','mere','tuteur','autre']);
            $table->string('telephone', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('profession', 150)->nullable();
            $table->text('adresse')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parents_tuteurs');
    }
};
