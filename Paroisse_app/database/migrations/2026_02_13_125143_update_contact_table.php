<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Renommer la table contact en contacts
        Schema::rename('contact', 'contacts');
    }

    public function down(): void
    {
        // Revenir en arrière si besoin
        Schema::rename('contacts', 'contact');
    }
};

