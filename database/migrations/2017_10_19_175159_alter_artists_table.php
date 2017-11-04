<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artists', function(Blueprint $table){
            $table->integer('user_insert')->nullable()->unsigned();
            $table->foreign('user_insert')->references('id')->on('users');
            $table->integer('user_update')->nullable()->unsigned();
            $table->foreign('user_update')->references('id')->on('users');
            $table->integer('user_delete')->nullable()->unsigned();
            $table->foreign('user_delete')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artists', function(Blueprint $table){
            $table->dropForeign('artists_user_insert_foreign');
            $table->dropColumn('user_insert');
            $table->dropForeign('artists_user_update_foreign');
            $table->dropColumn('user_update');
            $table->dropForeign('artists_user_delete_foreign');
            $table->dropColumn('user_delete');
        });
    }
}
