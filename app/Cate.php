<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    // 指定表明
    protected $table="category";
    // 指定主键id
    protected $primarKey="cate_id";
    // 关闭时间chuo1
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];


    public static function getPidData(){
    	return self::select('cate_id','cate_name')->where(['p_id'=>0,'is_nav_show'=>1])->take(4)->get();
    }
}
