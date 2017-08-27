<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //司机个人信息
        Schema::create('driver_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->index();
            $table->string('name');            
            $table->integer('old');
            $table->enum('sex',['M','F']);
            $table->string('phone');
            $table->text('head_img');
            $table->string('identity_card');//身份证号            
            $table->string('plate_number');//车牌号
            $table->string('type');//车型
            $table->string('capacity');//容量
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
        //
        Schema::dropIfExists('driver_infos');
    }
}
