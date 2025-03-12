<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->text('description');
            $table->json('specifications');
            $table->decimal('daily_rate', 10, 2);
            $table->decimal('weekly_rate', 10, 2);
            $table->decimal('monthly_rate', 10, 2);
            $table->string('image');
            $table->string('status')->default('available');
            $table->json('maintenance_history')->nullable();
            $table->json('current_location')->nullable();
            $table->string('tracking_device_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}; 