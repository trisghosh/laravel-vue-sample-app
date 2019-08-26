<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('player_id');
            $table->foreign('player_id')->references('id')->on('players')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('total_matches')->nullable();
            $table->integer('total_run')->nullable();
            $table->text('highest_score')->nullable();
            $table->text('no_of_fifties')->nullable();
            $table->text('hundreds')->nullable();

            $table->text('total_overs')->nullable();
            $table->text('run_given')->nullable();
            $table->text('totle_wickets')->nullable();
            $table->text('highest_wickets')->nullable();
            $table->text('five_wickets')->nullable();

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
        Schema::dropIfExists('player_details');
    }
}
