<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('btp_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->text('description');
            $table->string('before_image');
            $table->string('after_image');
            $table->string('location');
            $table->date('completion_date');
            $table->decimal('surface_area', 10, 2);
            $table->decimal('cost', 12, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('btp_projects');
    }
}; 