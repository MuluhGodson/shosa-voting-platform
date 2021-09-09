<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            //$table->string('email');
            //$table->string('sex');
            //$table->string('tel');
            //$table->date('dob');
            //$table->string('height');
            //$table->string('profession');
            //$table->string('town');
            //$table->text('bio');
            //$table->string('ig_link')->nullable();
            //$table->string('fb_link')->nullable();
            //$table->string('twitter_link')->nullable();
            $table->string('photo');
            //$table->unsignedBigInteger('division_id');
            $table->timestamps();

            //$table->foreign('division_id')->references('id')->on('divisions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
