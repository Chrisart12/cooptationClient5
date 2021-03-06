<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('jobs')) {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title', 255);
            $table->string('description');
            $table->string('lieu', 255);
            $table->string('reference', 255)->nullable();
            $table->integer('vaccancy_id');
            $table->string('url', 255);
            // $table->integer('category_id')->unsigned();
            // $table->foreign('category_id')->references('id')
            //                             ->on('categories')
            //                             ->onDelete('restrict')
            //                             ->onUpdate('restrict');
            // $table->integer('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')
            //                                 ->on('users')
            //                                 ->onDelete('restrict')
            //                                 ->onUpdate('restrict');
    
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
        Schema::dropIfExists('jobs');
    }
}
