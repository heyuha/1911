<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('goods_name',100);
            $table->string('goods_no',100);
            $table->string('goods_price',100);
            $table->string('goods_img',200);
            $table->string('goods_imgs',255);
            $table->string('goods_num',100);
            $table->bigInteger('is_slide');
            $table->bigInteger('cate_id');
            $table->bigInteger('brand_id');
            $table->bigInteger('is_best');
            $table->bigInteger('is_hot');
            $table->bigInteger('is_show');
            $table->text('goods_desc');
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
        Schema::dropIfExists('goods');
    }
}
