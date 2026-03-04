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
        // Table de liaison: Paiements et leurs articles/intentions/parking
        Schema::create('payment_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained('payments')->onDelete('cascade');
            $table->string('itemable_type'); // Type du modèle lié (MassIntention, Article, Parking)
            $table->unsignedBigInteger('itemable_id');
            $table->decimal('amount', 10, 2);
            $table->integer('quantity')->default(1);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['payment_id']);
            $table->index(['itemable_type', 'itemable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_items');
    }
};
