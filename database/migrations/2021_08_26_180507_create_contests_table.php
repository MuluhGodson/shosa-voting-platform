<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->boolean('active')->default(true);
            $table->boolean('fee')->default(false);
            $table->decimal('fee_amount')->nullable();
            $table->string('currency')->nullable();
            $table->boolean('vote_tarrif')->default(false);
            $table->string('vote_count')->default("1");
            $table->decimal('vote_fee')->nullable();
            $table->text('description');
            $table->string('max_participants')->nullable();
            $table->string('cover_image');
            $table->date('beginning_date');
            $table->date('ending_date');
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
        Schema::dropIfExists('contests');
    }
}
