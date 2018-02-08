<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->date('released')->nullable();
            
            $table->integer('user_insert')->nullable()->unsigned();
            $table->foreign('user_insert')->references('id')->on('Internal.users');
            $table->integer('user_update')->nullable()->unsigned();
            $table->foreign('user_update')->references('id')->on('Internal.users');
            $table->integer('user_delete')->nullable()->unsigned();
            $table->foreign('user_delete')->references('id')->on('Internal.users');
            
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
        Schema::dropIfExists('songs');
    }
}
