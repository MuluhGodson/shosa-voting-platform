<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contest_id');
            $table->unsignedBigInteger('candidate_id');
            $table->string('currency')->nullable();
            $table->string('amount')->nullable();
            $table->string('vote_count');
            $table->string('payment_type')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();

            $table->foreign('contest_id')->references('id')->on('contests');
            $table->foreign('candidate_id')->references('id')->on('candidates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
