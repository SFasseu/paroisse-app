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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->enum('payment_type', ['tithe', 'donation', 'offering', 'service']);
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('XAF');
            $table->enum('payment_method', ['cash', 'mobile_money', 'bank_transfer', 'check']);
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            
            $table->text('description')->nullable();
            $table->string('reference_number')->unique();
            $table->dateTime('payment_date');
            
            $table->dateTime('confirmed_at')->nullable();
            $table->foreignId('confirmed_by')->nullable()->constrained('users');
            
            $table->text('notes')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('user_id');
            $table->index('status');
            $table->index('payment_date');
            $table->index('payment_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
