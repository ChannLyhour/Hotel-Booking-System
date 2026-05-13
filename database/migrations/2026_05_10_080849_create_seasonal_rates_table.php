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
        Schema::create('seasonal_rates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('room_type_id')->index();
            $table->string('name');
            $table->date('date_from');
            $table->date('date_to');
            $table->decimal('multiplier', 5, 2)->default(1.00);
            $table->integer('override_price_cents')->nullable();
            $table->integer('priority')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasonal_rates');
    }
};
