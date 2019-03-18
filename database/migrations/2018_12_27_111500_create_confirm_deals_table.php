<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirm_deals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('交易者id');
            $table->integer('deal_id')->comment('交易帖子ID');
            $table->integer('num')->comment('交易的数量');
            $table->integer('total')->comment('交易的总金额');
            $table->string('message')->comment('交易的留言');
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
        Schema::dropIfExists('confirm_deals');
    }
}
