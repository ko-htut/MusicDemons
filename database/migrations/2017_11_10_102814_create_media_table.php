<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('subject_id')->nullable()->unsigned();
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->integer('medium_type_id')->nullable()->unsigned();
            $table->foreign('medium_type_id')->references('id')->on('medium_types');
            $table->string('value');
            
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
        Schema::dropIfExists('media');
    }
}
