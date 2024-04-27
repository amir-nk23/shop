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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile')->unique();
            $table->string('password');
            $table->string('email')->nullable();
            $table->string('national_code')->unique()->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });

        \Modules\Customer\Models\Customer::query()->create([

            'name'=>'امیر',
            'mobile'=>'',
            'password'=>bcrypt('123456'),
            'email'=>'amir@gmail.com',
            'national_code'=>'4580458648',
            'status'=>1

        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
