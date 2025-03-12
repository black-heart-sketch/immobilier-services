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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['terrain', 'maison']);
            $table->text('description');
            $table->decimal('price', 12, 2);
            $table->decimal('surface_area', 10, 2);
            $table->string('location');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 10, 8);
            $table->json('features');
            $table->json('images')->nullable();
            $table->enum('status', ['available', 'pending', 'sold'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
