<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('equipment_rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id')->constrained()->onDelete('cascade');
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('company_name')->nullable();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('rental_type');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('deposit_amount', 10, 2);
            $table->string('status')->default('pending');
            $table->boolean('contract_signed')->default(false);
            $table->string('contract_file')->nullable();
            $table->string('payment_status')->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipment_rentals');
    }
}; 