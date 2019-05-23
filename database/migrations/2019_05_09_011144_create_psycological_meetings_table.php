<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePsycologicalMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psycological_meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('content');

            $table->bigInteger('child_id')->unsigned()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('child_id')->references('id')->on('children');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psycological_meetings');
    }
}
