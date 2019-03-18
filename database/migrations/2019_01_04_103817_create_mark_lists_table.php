<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarkListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mark_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mark_type')->comment('0 好评 1 中评 2 差评');
            $table->integer('deal_id')->comment('交易帖子id');
            $table->integer('from_user_id')->comment('评论人');
            $table->integer('to_user_id')->comment('被评论人');
            $table->integer('mark')->comment('分数');
            $table->string('message')->comment('评分留言');
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
        Schema::dropIfExists('mark_lists');
    }
}
