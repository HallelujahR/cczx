<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique()->comment('对应用户表id');
            $table->string('telephone')->default(0)->comment('电话');
            $table->integer('sex')->default(0)->comment('性别');
            $table->string('birthday')->default(0)->comment('生日');
            $table->string('email')->default(0)->comment('邮箱');
            $table->string('qq')->default(0)->comment('qq');
            $table->string('vx')->default(0)->comment('vx');
            $table->string('postIntegral')->default(0)->comment('发帖积分');
            $table->string('articleIntegral')->default(0)->comment('文章积分');
            $table->string('transaction')->default(0)->comment('交易等级');
            $table->string('creditscore')->default(0)->comment('信用积分');
            $table->string('scoringtimes')->default(0)->comment('评分次数');
            $table->string('alipay')->default(0)->comment('支付宝');
            $table->integer('transactionTimes')->default(0)->comment('交易次数');
            $table->integer('transactionAmount')->default(0)->comment('交易金额');
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
        Schema::dropIfExists('user_details');
    }
}
