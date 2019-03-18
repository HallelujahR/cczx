<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevokesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revokes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('发布人');
            $table->integer('check')->comment('1:买盘2:卖盘');
            $table->integer('deal_cate')->comment('买盘卖盘种类');
            $table->string('shopName')->comment('商品名称');
            $table->string('productPhase')->comment('品相');
            $table->string('unit')->comment('单位');
            $table->integer('num')->comment('数量');
            $table->integer('unitPrice')->comment('单价');
            $table->integer('total')->comment('总价');
            $table->integer('otherExpenses')->comment('其他费用');
            $table->integer('minQuantity')->comment('最小确认数量');
            $table->string('deliveryMethods')->comment('交割方式');
            $table->string('validity')->comment('卖盘有效期');
            $table->string('instructions')->comment('其他说明');
            $table->integer('item')->comment('使用道具');
            $table->integer('anonymousPosting')->comment('匿名发帖0:可见1:匿名');
            $table->integer('sms')->comment('手机通知：0不通知，1通知');
            $table->string('caption')->comment('图片说明');
            $table->mediumText('pic')->comment('存入多张图片的链接');
            $table->integer('mallGoods')->comment('关联商城中的商品，有则记录id无则为0');
            $table->integer('upper')->comment('父级');
            $table->integer('trader')->comment('交易人');
            $table->integer('status')->comment('状态：0等待交易，1确认交易，2卖家确认交割');
            $table->integer('views')->comment('浏览量');
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
        Schema::dropIfExists('revokes');
    }
}
