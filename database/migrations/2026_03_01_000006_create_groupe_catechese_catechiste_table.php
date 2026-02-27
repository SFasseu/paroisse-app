<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('groupe_catechese_catechiste', function (Blueprint $table) {
            $table->id();
            $table->foreignId('groupe_catechese_id')->constrained('groupes_catechese')->onDelete('cascade');
            $table->foreignId('catechiste_id')->constrained('catechistes')->onDelete('cascade');
            $table->enum('role', ['principal', 'assistant'])->default('assistant');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groupe_catechese_catechiste');
    }
};
