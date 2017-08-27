<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //车次信息
        Schema::create('car_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('driver_id')->index();
            $table->string('route');
            $table->string('time');
            $table->integer('allowance');//剩余座位
            $table->enum('status',[0,1])->default(0)->index();//完成预约为1，未完成为0
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
        Schema::dropIfExists('car_infos');
    }
}
