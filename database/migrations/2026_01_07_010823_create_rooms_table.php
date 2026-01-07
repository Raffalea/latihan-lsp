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
            $table->id();
            $table->string('room_number')->unique(); // Contoh: A-101
            $table->enum('type', ['Superior', 'Deluxe', 'Signature Suite']); // Tipe mewah
            $table->integer('price_per_night');
            $table->text('facilities'); // Contoh: Wifi, Bathtub, Mini Bar
            $table->enum('status', ['available', 'booked', 'maintenance'])->default('available');
            $table->string('image')->nullable(); // Opsional untuk foto
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
