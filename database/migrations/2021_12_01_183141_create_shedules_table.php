<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\support\Facades\Schema;

class CreateShedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shedules', function (Blueprint $table) {
            $table->increments('id');
            //создание поля для связывания с таблицей classes
            $table->integer('class_id')->unsigned()->default(0);
            //создание внешнего ключа для поля 'class_id', который связан с полем id таблицы 'classes'
            $table->foreign('class_id')->references('id')->on('classes');
            //создание поля для связывания с таблицей subjects
            $table->integer('subject_id')->unsigned()->default(0);
            //создание внешнего ключа для поля 'subject_id', который связан с полем id таблицы 'subjects'
            $table->foreign('subject_id')->references('id')->on('subjects');
            //создание поля для связывания с таблицей days
            $table->integer('day_number')->unsigned()->default(0);
            //создание внешнего ключа для поля 'day_number', который связан с полем number таблицы 'days'
            $table->foreign('day_number')->references('number')->on('days');
            //создание поля для связывания с таблицей lessons
            $table->integer('lesson_number')->unsigned()->default(0);
            //создание внешнего ключа для поля 'lesson_number', который связан с полем number таблицы 'lessons'
            $table->foreign('lesson_number')->references('number')->on('lessons');
            //создание поля для связывания с таблицей cabinets
            $table->integer('cabinet_id')->unsigned()->default(0);
            //создание внешнего ключа для поля 'cabinet_id', который связан с полем id таблицы 'cabinets'
            $table->foreign('cabinet_id')->references('id')->on('cabinets');
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
        Schema::dropIfExists('shedules');
    }
}
