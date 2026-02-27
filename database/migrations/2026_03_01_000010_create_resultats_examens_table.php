<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resultats_examens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catechumene_id')->constrained('catechumenes')->onDelete('cascade');
            $table->foreignId('examen_id')->constrained('examens')->onDelete('cascade');
            $table->decimal('note_obtenue', 5, 2);
            $table->date('date_examen');
            $table->enum('statut', ['reussi','echoue','absent'])->default('reussi');
            $table->text('observations')->nullable();
            $table->foreignId('enregistre_par')->nullable()->constrained('users')->nullOnDelete();
            $table->unique(['catechumene_id', 'examen_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resultats_examens');
    }
};
