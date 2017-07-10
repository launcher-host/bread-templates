<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoyagerTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('voyager_templates')){
            Schema::create('voyager_templates', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->text('view')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('voyager_templates');
    }
}
