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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('no action');
            $table->text('description');
            $table->enum('status',['draft','available','unavailable']);
            $table->enum('discount_type',['percent','flat'])->nullable();
            $table->unsignedBigInteger('discount')->nullable();
            $table->unsignedBigInteger('price');
//            image media library
//            images media library
            $table->unsignedBigInteger('quantity')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
