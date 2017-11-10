<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Entities\Person;
use App\Entities\Artist;
use App\Entities\Song;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subjectable_id')->unsigned()->index();
            $table->string('subjectable_type')->nullable();
            $table->timestamps();
        });
        
        foreach(Person::all() as $person) {
            $person->subject()->create();
        }
        foreach(Artist::all() as $artist) {
            $artist->subject()->create();
        }
        foreach(Song::all() as $song) {
            $song->subject()->create();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
