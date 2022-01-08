<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('stories')) {
            Schema::create('stories', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')
                                        ->on('users')
                                        ->onDelete('restrict')
                                        ->onUpdate('restrict');
                $table->string('story')->nullable();
                $table->string('picture_path')->nullable()->default(null)->unique();
                $table->string('bg_position_x')->default('center');
                $table->string('bg_position_y')->default('center');
                $table->boolean('is_active')->default(0);
                $table->boolean('is_done')->default(0);
                $table->boolean('is_demo')->default(0);
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
        Schema::dropIfExists('stories');
    }
}
