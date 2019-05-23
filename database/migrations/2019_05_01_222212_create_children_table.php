<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('photo')->nullable();

            $table->enum('civility',['M','F'])->default('M');
            $table->string('cin')->nullable();

            $table->string('first_name_ar')->nullable();
            $table->string('first_name_fr')->nullable();
            $table->string('last_name_ar')->nullable();
            $table->string('last_name_fr')->nullable();

            $table->date('birthday')->nullable();

            $table->string('born_place_fr')->nullable();
            $table->string('born_place_ar')->nullable();

            $table->string('health_state_fr');
            $table->string('health_state_ar');

            $table->date('entree_date')->nullable();
            $table->date('leave_date')->nullable();

            $table->string('inscription_number');
            $table->string('rassm_number');
            $table->string('judge_number');

            $table->string('province_fr')->nullable();
            $table->string('province_ar')->nullable();

            // Famille
            $table->string('father_name')->nullable();
            $table->string('father_cin')->nullable();
            $table->string('father_place')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('father_pro')->nullable();
            $table->string('father_situation')->nullable();

            $table->text('description')->nullable();


            $table->softDeletes();
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
        Schema::dropIfExists('children');
    }
}
