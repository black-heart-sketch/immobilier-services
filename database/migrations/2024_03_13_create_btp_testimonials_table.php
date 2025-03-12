<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('btp_testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('btp_project_id')
                ->references('id')
                ->on('btp_projects')
                ->onDelete('cascade');
            $table->string('client_name');
            $table->text('content');
            $table->integer('rating');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('btp_testimonials');
    }
}; 