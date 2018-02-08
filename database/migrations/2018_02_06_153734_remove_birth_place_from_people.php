<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveBirthPlaceFromPeople extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('people',function(Blueprint $table) {
            $table->dropColumn('birth_place');
            
            $table->integer('birth_place_id')->nullable()->unsigned()->after('died');
            $table->foreign('birth_place_id')->references('id')->on('Addresses.places');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('people',function(Blueprint $table) {
            $table->dropForeign('people_birth_place_id_foreign');
            $table->dropColumn('birth_place_id');
            
            $table->string('birth_place')->nullable();
        });
    }
}
