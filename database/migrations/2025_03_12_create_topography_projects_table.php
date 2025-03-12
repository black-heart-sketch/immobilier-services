<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('topography_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type'); // bornage, nivellement, etc.
            $table->text('description');
            $table->json('images');
            $table->string('location');
            $table->date('completion_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('topography_projects');
    }
}; 