<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->nullable();
            $table->string('designation');
            $table->integer('codaentrege')->nullable();
            $table->date('entree');
            $table->date('leave');
            $table->integer('life_time');
            $table->double('value');
            $table->double('actual_value');

            $table->bigInteger('source_id')->unsigned()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('source_id')->references('id')->on('sources');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
