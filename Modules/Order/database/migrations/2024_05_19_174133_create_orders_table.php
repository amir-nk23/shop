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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('no action');
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')
                ->references('id')
                ->on('addresses')
                ->onDelete('no action');
            $table->json('address');
            $table->unsignedBigInteger('amount');
            $table->text('description')->nullable();
            $table->enum('status',['wait_for_payment','new','failed','in_progress','delivered']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
