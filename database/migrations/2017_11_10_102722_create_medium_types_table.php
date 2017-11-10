<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediumTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medium_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('base_url');
            
            $table->integer('user_insert')->nullable()->unsigned();
            $table->foreign('user_insert')->references('id')->on('users');
            $table->integer('user_update')->nullable()->unsigned();
            $table->foreign('user_update')->references('id')->on('users');
            $table->integer('user_delete')->nullable()->unsigned();
            $table->foreign('user_delete')->references('id')->on('users');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medium_types');
    }
}
