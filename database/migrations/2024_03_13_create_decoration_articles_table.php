<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('decoration_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->string('image');
            $table->string('author_name');
            $table->integer('reading_time');
            $table->json('tags');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('decoration_articles');
    }
}; 