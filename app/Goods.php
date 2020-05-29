<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    // 指定表明
    protected $table="goods";
    // 指定主键id
    protected $primarKey="goods_id";
    // 关闭时间chuo1
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];


    public static function getSliceData(){
    	return self::select('goods_id','goods_img')->where('is_slide',1)->take(5)->get();
    }


}
