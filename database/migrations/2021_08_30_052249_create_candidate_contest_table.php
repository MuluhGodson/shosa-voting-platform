<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateContestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_contest', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id');
            $table->unsignedBigInteger('contest_id');
            $table->string('candidate_number');
            $table->boolean('paid')->default(false);
            $table->string('payment_type')->nullable();
            $table->string('serial');
            $table->timestamps();


            $table->unique('serial');
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('contest_id')->references('id')->on('contests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_contest');
    }
}
