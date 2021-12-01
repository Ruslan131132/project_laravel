<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->increments('id');
            //создание поля для связывания с таблицей pupil
            $table->integer('pupil_id')->unsigned();
            //создание внешнего ключа для поля 'pupil_id', который связан с полем id таблицы 'pupils'
            $table->foreign('pupil_id')->references('id')->on('pupils');
            //создание поля для связывания с таблицей subjects
            $table->integer('subject_id')->unsigned();
            //создание внешнего ключа для поля 'subject_id', который связан с полем id таблицы 'subjects'
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->integer('mark');
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
        Schema::dropIfExists('marks');
    }
}
