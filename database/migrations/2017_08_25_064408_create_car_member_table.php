<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //司机个人信息
        Schema::create('car_members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone')->unique();
            $table->string('nick');
            $table->text('head_img');
            $table->string('password');
            $table->enum('type',['D','P'])->default('P')->index();
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
        Schema::dropIfExists('car_members');
    }
}
