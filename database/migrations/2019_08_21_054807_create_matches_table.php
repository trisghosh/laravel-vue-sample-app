<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedBigInteger('against_team_id');
            $table->foreign('against_team_id')->references('id')->on('teams')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('winner_team_id');
            $table->foreign('winner_team_id')->references('id')->on('teams')
                ->onUpdate('cascade')->onDelete('cascade');
    
            $table->integer('total_tun_scored')->unsigned()->nullable();
            $table->text('result'); //Win, Tie, Abondaned 
            $table->text('comments')->nullable(); 
            $table->text('description')->nullable();            
                
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
        Schema::dropIfExists('match');
    }
}
