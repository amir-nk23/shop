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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->enum('group',['general','social']);
            $table->string('label');
            $table->string('name');
            $table->enum('type',['text','textarea','img']);
            $table->text('value');
            $table->timestamps();
        });



        \Modules\Setting\Models\Setting::create([

            'group'=>'social',
            'name'=>'instagram',
            'label'=>'اینستاگرام',
            'type'=>'text',
            'value'=>'example',

        ]);

        \Modules\Setting\Models\Setting::create([

            'group'=>'social',
            'name'=>'telegram',
            'label'=>'تلکرام',
            'type'=>'text',
            'value'=>'example',

        ]);

        \Modules\Setting\Models\Setting::create([

            'group'=>'general',
            'name'=>'mobile',
            'label'=>'موبایل',
            'type'=>'text',
            'value'=>'09395439774',

        ]);

        \Modules\Setting\Models\Setting::create([

            'group'=>'general',
            'name'=>'img',
            'label'=>'عکس',
            'type'=>'img',
            'value'=>'example',

        ]);

        \Modules\Setting\Models\Setting::create([

            'group'=>'general',
            'name'=>'address',
            'label'=>'ادرس',
            'type'=>'textarea',
            'value'=>'example',

        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
