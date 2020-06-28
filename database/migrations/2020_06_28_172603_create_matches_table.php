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
             $table->decimal('from_team_score')->default('0.00');
             $table->decimal('to_team_score')->default('0.00');
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
