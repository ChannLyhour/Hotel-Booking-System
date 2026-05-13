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
            $table->uuid('id')->primary();
            $table->uuid('booking_id')->index();
            $table->uuid('payment_method_id')->index();
            $table->string('transaction_id')->unique();
            $table->integer('amount_cents')->default(0);
            $table->string('currency_code', 3)->default('USD');
            $table->string('status')->default('pending'); // pending, completed, failed, refunded
            $table->string('gateway')->nullable();
            $table->json('gateway_response')->nullable();
            $table->string('refund_transaction_id')->nullable();
            $table->integer('refunded_amount_cents')->default(0);
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
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
