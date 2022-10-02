<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table){
            $table->increments('id');
            $table->string('url');
            //$table->string('hashname');
            //$table->string('originalname');
            $table->string('cropName');
            $table->string('sickNameKor');
            $table->integer('confidence')->default(100);
            $table->timestamps();
        });
        Schema::create('train', function (Blueprint $table){
            $table->increments('id');
            $table->string('url');
            $table->string('hashname');
            $table->string('originalname');
            $table->string('cropName');
            $table->string('sickNameKor');
            $table->integer('confidence')->default(100);
            $table->string('userOpinion')->default('없음');
            $table->integer('modify')->default(0);
            $table->timestamps();
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
        Schema::dropIfExists('train');
    }
}
