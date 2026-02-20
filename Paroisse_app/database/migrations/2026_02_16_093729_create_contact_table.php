<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
    public function up(): void
{
    Schema::create('contact', function (Blueprint $table) {
        $table->id();                 // identifiant unique
        $table->string('nom');        // nom du contact
        $table->string('email');      // email
        $table->string('telephone');  // téléphone
        $table->timestamps();         // created_at & updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact');
    }
};
