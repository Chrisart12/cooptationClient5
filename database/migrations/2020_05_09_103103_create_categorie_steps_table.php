
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorieStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('categorie_step')) {
        Schema::create('categorie_step', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('step_id')->unsigned();
            $table->foreign('step_id')->references('id')
                                        ->on('steps')
                                        ->onDelete('restrict')
                                        ->onUpdate('restrict');
            $table->integer('categorie_id')->unsigned();
            $table->foreign('categorie_id')->references('id')
                                        ->on('categories')
                                        ->onDelete('restrict')
                                        ->onUpdate('restrict');
            $table->integer('ordre');
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
        Schema::dropIfExists('categorie_step');
    }
}
