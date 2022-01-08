<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('candidats')) {
        Schema::create('candidats', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('firstname', 60);
            $table->string('lastname', 60);
            $table->string('email', 255);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                                        ->on('users')
                                        ->onDelete('restrict')
                                        ->onUpdate('restrict');
            $table->integer('job_id')->unsigned();
            $table->foreign('job_id')->references('id')
                                        ->on('jobs')
                                        ->onDelete('restrict')
                                        ->onUpdate('restrict');
            $table->integer('step_id')->unsigned();
            $table->foreign('step_id')->references('id')
                                        ->on('steps')
                                        ->onDelete('restrict')
                                        ->onUpdate('restrict');
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidats');
    }
}
