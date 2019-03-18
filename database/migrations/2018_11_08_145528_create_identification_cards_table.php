<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentificationCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identification_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique();
            $table->string('realName')->default('0')->comment('真实姓名');
            $table->string('idCard')->default('0')->comment('身份证号码');
            $table->string('positive')->default('0')->comment('身份证正面');
            $table->string('opposite')->default('0')->comment('身份证反面');
            $table->string('hold')->default('0')->comment('手持身份证');
            $table->integer('status')->default(0)->comment('0未审核 1审核中 2审核失败 3审核成功');
            $table->string('info')->default('0')->comment('审核失败的提示信息');
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
        Schema::dropIfExists('identification_cards');
    }
}
