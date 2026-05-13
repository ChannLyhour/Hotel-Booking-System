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
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reference')->unique();
            $table->uuid('guest_id')->index();
            $table->uuid('user_id')->nullable()->index();
            $table->uuid('hotel_id')->index();
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('nights');
            $table->string('status')->default('confirmed'); // pending, confirmed, cancelled, checked_in, checked_out
            $table->string('source')->default('direct'); // direct, ota, agency
            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            $table->integer('total_amount_cents')->default(0);
            $table->integer('paid_amount_cents')->default(0);
            $table->string('currency_code', 3)->default('USD');
            $table->text('special_requests')->nullable();
            $table->json('metadata')->nullable();
            $table->uuid('cancelled_by')->nullable()->index();
            $table->text('cancellation_reason')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
