<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Helpers;
use App\Entities\MediumType;

class AddIconToMediumTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medium_types',function(Blueprint $table) {
            $table->string('icon_url')->after('base_url');
        });
        
        foreach(MediumType::all() as $mediumType) {
            $mediumType->icon_url = Helpers::get_icon("https://" . $mediumType->base_url);
            $mediumType->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medium_types',function(Blueprint $table) {
            $table->dropColumn('icon_url');
        });
    }
}
