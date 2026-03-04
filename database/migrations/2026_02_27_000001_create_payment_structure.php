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
        // Table des systèmes de paiement (ex: Mobile Money, Banque, Espèces)
        Schema::create('payment_systems', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "Mobile Money", "Banque", "Espèces"
            $table->string('code')->unique(); // "mobile_money", "bank", "cash"
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Table des modes de paiement (ex: Orange Money, MTN, Virement)
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_system_id')->constrained('payment_systems')->onDelete('cascade');
            $table->string('name'); // "Orange Money", "MTN Money", "Virement UCEC"
            $table->string('code')->unique(); // "orange_money", "mtn_money", "ucec_transfer"
            $table->text('description')->nullable();
            $table->decimal('fee_percentage', 5, 2)->default(0);
            $table->decimal('fee_fixed', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('payment_system_id');
        });

        // Table des intentions de messe
        Schema::create('mass_intentions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('suggested_amount', 10, 2)->default(5000);
            $table->string('currency', 3)->default('XAF');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Table des articles (ex: Cierges, Livres, etc.)
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quantity_available')->nullable();
            $table->string('currency', 3)->default('XAF');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Table du parking
        Schema::create('parking', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->integer('total_spaces');
            $table->integer('available_spaces');
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->decimal('daily_rate', 10, 2)->nullable();
            $table->string('currency', 3)->default('XAF');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('mass_intentions');
        Schema::dropIfExists('payment_methods');
        Schema::dropIfExists('payment_systems');
    }
};
