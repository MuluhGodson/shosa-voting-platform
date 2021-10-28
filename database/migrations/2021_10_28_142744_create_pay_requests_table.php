<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_requests', function (Blueprint $table) {
            $table->id();
            $table->string('tel');
            $table->string('amount');
            $table->string('currency');
            $table->string('status');
            $table->unsignedBigInteger('candidate_id');
            $table->string('vote_count');
            $table->string('pay_service');
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
        Schema::dropIfExists('pay_requests');
    }
}
