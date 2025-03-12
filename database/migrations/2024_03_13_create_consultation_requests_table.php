<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('consultation_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('project_type');
            $table->text('description');
            $table->date('preferred_date');
            $table->string('preferred_time');
            $table->string('budget_range');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultation_requests');
    }
}; 