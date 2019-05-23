<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('n_inventory');
            $table->integer('n_lose')->nullable();
            $table->date('lose_date')->nullable();
            $table->text('description')->nullable();

            $table->bigInteger('place_id')->unsigned()->index();
            $table->bigInteger('inventory_id')->unsigned()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('place_id')->references('id')->on('places')->onUpdate('cascade');
            $table->foreign('inventory_id')->references('id')->on('inventories')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
