<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('siteName')->comment('网站名称');
            $table->string('website')->comment('网站网址');
            $table->string('logo')->comment('网站logo');
            $table->string('contacts')->comment('联系人');
            $table->string('qq')->comment('qq');
            $table->string('email')->comment('邮箱');
            $table->string('phone')->comment('手机');
            $table->string('telephone')->comment('固定电话');
            $table->string('address')->comment('具体地址');
            $table->string('title')->comment('首页标题');
            $table->string('keywords')->comment('首页关键词');
            $table->string('description')->comment('首页描述');
            $table->string('longPic')->comment('导航头');
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
        Schema::dropIfExists('configs');
    }
}
