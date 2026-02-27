<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sacrements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catechumene_id')->constrained('catechumenes')->onDelete('cascade');
            $table->enum('type_sacrement', ['bapteme','premiere_communion','confirmation','mariage','ordre']);
            $table->date('date_sacrement');
            $table->string('lieu_sacrement', 200)->nullable();
            $table->string('pretre_officiant', 150)->nullable();
            $table->string('parrain', 150)->nullable();
            $table->string('marraine', 150)->nullable();
            $table->string('numero_registre', 100)->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sacrements');
    }
};
