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
        Schema::create('rate_plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('room_type_id')->index();
            $table->string('name');
            $table->string('code')->unique();
            $table->integer('price_cents')->default(0);
            $table->boolean('includes_breakfast')->default(false);
            $table->boolean('is_refundable')->default(true);
            $table->integer('cancellation_days')->default(1);
            $table->json('restrictions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_plans');
    }
};
