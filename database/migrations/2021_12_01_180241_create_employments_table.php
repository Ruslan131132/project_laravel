<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employments', function (Blueprint $table) {
            $table->increments('id');
            //создание поля для связывания с таблицей teachers
            $table->integer('teacher_id')->unsigned();
            //создание внешнего ключа для поля 'teacher_id', который связан с полем id таблицы 'teachers'
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->integer('subject_id')->unsigned();
            //создание внешнего ключа для поля 'subject_id', который связан с полем id таблицы 'subjects'
            $table->foreign('subject_id')->references('id')->on('subjects');
            //создание поля для связывания с таблицей classes
            $table->integer('class_id')->unsigned();
            //создание внешнего ключа для поля 'class_id', который связан с полем id таблицы 'classes'
            $table->foreign('class_id')->references('id')->on('classes');
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
        Schema::dropIfExists('employments');
    }
}
