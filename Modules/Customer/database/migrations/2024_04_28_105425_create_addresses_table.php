<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('no action');
            $table->string('name')->nullable();
            $table->string('mobile');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('no action');
            $table->text('address');
            $table->string('postal_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
