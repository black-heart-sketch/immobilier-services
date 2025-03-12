<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('decoration_services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('icon');
            $table->string('image');
            $table->json('features');
            $table->string('price_range');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('decoration_services');
    }
}; 