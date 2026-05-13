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
        Schema::create('rooms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('room_type_id')->index();
            $table->string('number')->unique();
            $table->integer('floor')->nullable();
            $table->string('status')->default('available'); // available, occupied, maintenance, cleaning
            $table->json('features')->nullable();
            $table->timestamp('last_cleaned_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
