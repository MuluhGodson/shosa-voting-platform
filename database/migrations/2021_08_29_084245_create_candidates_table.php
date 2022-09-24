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
            $table->string('email')->nullable();
            $table->string('sex');
            $table->string('tel')->nullable();
            $table->string('candidate_number')->nullable();
            $table->string('photo')->nullable();
            $table->string('town')->nullable();
            $table->text('reason_for_participation')->nullable();
            $table->text('bio')->nullable();
            $table->string('ig_link')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('twitter_link')->nullable();        
            $table->timestamps();

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
