<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('decoration_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('type');
            $table->string('before_image');
            $table->string('after_image');
            $table->json('additional_images')->nullable();
            $table->string('client_name');
            $table->text('testimonial');
            $table->date('completion_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('decoration_projects');
    }
}; 