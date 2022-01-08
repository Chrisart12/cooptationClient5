<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')) {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->foreign('region_id')->references('id')
                                        ->on('regions')
                                        ->onDelete('restrict')
                                        ->onUpdate('restrict');
            $table->integer('responsible_id')->unsigned();
            $table->foreign('responsible_id')->references('id')
                                            ->on('responsibles')
                                            ->onDelete('restrict')
                                            ->onUpdate('restrict');
            $table->string('firstname', 60);
            $table->string('lastname', 60);
            $table->string('institution', 255);
            $table->string('job', 255);
            $table->string('departement', 255)->nullable();
            $table->string('email')->unique();
            $table->string('token', 60);
            $table->string('verify_email_token')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
