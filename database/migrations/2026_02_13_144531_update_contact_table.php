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
        // Vérifier si la table contact existe avant de renommer
        if (Schema::hasTable('contact') && !Schema::hasTable('contacts')) {
            Schema::rename('contact', 'contacts');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('contacts') && !Schema::hasTable('contact')) {
            Schema::rename('contacts', 'contact');
        }
    }
};
