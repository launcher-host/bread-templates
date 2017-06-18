<?php
/*
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


if(! Schema::hasTable('voyager_templates')) {
    Schema::create('voyager_templates', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name')->unique();
        $table->string('slug')->unique();
        $table->text('view')->nullable();
        $table->timestamps();
    });
}
*/

file_put_contents(__DIR__.'/install.log', 'installed');
