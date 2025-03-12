<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('scientific_name');
            $table->string('category'); // tree, shrub, flower, etc.
            $table->text('description');
            $table->text('care_instructions');
            $table->json('specifications')->nullable(); // height, width, growth rate, etc.
            $table->json('benefits')->nullable(); // ecological and economic benefits
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->string('image');
            $table->json('gallery')->nullable(); // additional images
            $table->boolean('available_wholesale')->default(false);
            $table->decimal('wholesale_min_quantity', 10, 2)->nullable();
            $table->decimal('wholesale_price', 10, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('plant_orders', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('delivery_address')->nullable();
            $table->boolean('is_wholesale')->default(false);
            $table->string('status')->default('pending');
            $table->decimal('total_amount', 10, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('plant_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('plant_orders')->onDelete('cascade');
            $table->foreignId('plant_id')->constrained('plants')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plant_order_items');
        Schema::dropIfExists('plant_orders');
        Schema::dropIfExists('plants');
    }
}; 