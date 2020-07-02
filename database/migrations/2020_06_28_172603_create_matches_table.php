<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
             $table->string('title');
             $table->timestamp('start_at');
             $table->unsignedBigInteger('from_team_id');
             $table->unsignedBigInteger('to_team_id');
             $table->enum('type',['T20','ODI','TEST']);
             $table->enum('is_complete',['yes','no'])->default('no');
             $table->string('place');
             $table->foreign('from_team_id')->references('id')->on('teams');
             $table->foreign('to_team_id')->references('id')->on('teams');
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
        Schema::dropIfExists('matches');
    }
}
