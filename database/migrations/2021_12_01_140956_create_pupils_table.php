<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePupilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pupils', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable(false);
            $table->string('surname', 255)->nullable(false);
            $table->string('patronymic', 255)->nullable(true);
            //создание поля для связывания с таблицей Classes
            $table->integer('class_id')->unsigned();
            //создание внешнего ключа для поля 'class_id', который связан с полем id таблицы 'classes'
            $table->foreign('class_id')->references('id')->on('classes');
            $table->string('address', 255)->nullable(true);
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
        Schema::dropIfExists('pupils');
    }
}
