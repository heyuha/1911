<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    public function index(){
        // memcache//
        // Cache::flush();
        // $slice = Cache::get("slice");
        // $slice = cache("slice");
        // Redis::del('slice');
        // redis
        $slice = Redis::get("slice");
        // dd($slice);
        if(!$slice){
            echo "DB==";
            // 首页幻灯片
            $slice = Goods::getSliceData();

            // 存memcache  
            // Cache::put('slice',$slice,60*60*24*7);
            // cache(['slice'=>$slice],60);
            $slice = serialize($slice);
            // 存redis
            Redis::setex('slice',60,$slice);
        }
    	
        $slice = unserialize($slice);
        // dd($slice);

        // $p_id = Cache::get("p_id");
        // $p_id = cache('p_id');
        $p_id = Redis::get('p_id');
        // dd($p_id);
        if(!$p_id){
            // echo "DB==";
            // 获取顶级分类
            $p_id = Cate::getPidData();
            // Cache::put("p_id",$p_id,60*60*24*7);
            // cache(['p_id'=>$p_id],60);
            // 
            $p_id = serialize($p_id);
            Redis::setex("p_id",60,$p_id);
        }
    	$p_id = unserialize($p_id);
    	// dd($p_id);

    	// 首页精品展示
        $best = Goods::select('goods_id','goods_img','goods_name','goods_price')->where('is_best',1)->take(8)->get();
        $session = session('member');
        // dd($session);
    	return view("index.index",['slice'=>$slice,'p_id'=>$p_id,'best'=>$best,'session'=>$session]);
    }
}
