<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Car;
class CarController extends Controller
{
    public function caradd(Request $request){
    	// 接值
    	$buy_number = $request->buy_number;
    	$goods_id = $request->goods_id;
    	
    	// 获取到登录用户的信息
    	$user = session('member');
    	// echo $user;

        if(!$user){
            echo json_encode(['code'=>00002,'msg'=>"请先登录"]);die;
        }

    	// 根据商品的id查询商品表
    	$goodsInfo = Goods::select('goods_id','goods_name','goods_price','goods_img','goods_num')->where('goods_id',$goods_id)->first();

    	// 根据获取到的商品信息 跟buy_number作比较
    	if($goodsInfo->goods_num<$buy_number){
    		echo json_encode(['code'=>00001,'msg'=>'商品库存不足']);die;
    	}

        // 根据商品id用户id拼接where条件
        $where = [
            'user_id' => $user['member_id'],
            'goods_id' => $goods_id
        ];

        // 根据where条件查询分类表一条数据
        $carInfo = Car::where($where)->first();
        // dd($carInfo);
        if($carInfo){
            // 有值更新购买数量
            $buy_number = $carInfo->buy_number+$buy_number;
            // dd($buy_number);
            // 判断购买数量大于商品库存 购买数量=商品库存
            if($goodsInfo->goods_num<$buy_number){
                $buy_number=$goodsInfo->goods_num;
            }
            $res = Car::where('car_id',$carInfo['car_id'])->update(['buy_number'=>$buy_number]);

        }else{
            // 数据库中没有此用户的购买记录 
            // 添加购物车数据
            $data = [
                'user_id' => $user['member_id'],
                'buy_number'=>$buy_number,
                'addtime'=>time()
            ];
            $data = array_merge($data,$goodsInfo->toArray());
            // dd($data);
            unset($data['goods_num']);
            // dd($data);
            $res = Car::create($data);
        }

        if($res!=false){
            echo json_encode(['code'=>00000,'msg'=>'加入购物车成功']);die;
        }



    }

    // 购物车列表
    public function carcar(Request $request){
        // 取出用户id
        $user_id = session('member')->member_id;
        // dd($member_id);
        $carInfo = \DB::select("select *,buy_number*goods_price as price from car where user_id=?",[$user_id]);
        // dd($carInfo);

        // 每个商品的购买数量
        $buy_number = array_column($carInfo,'buy_number');
        // dd($count);

        //总商品购买数量
        $count = array_sum($buy_number);
        // dd($count);

        // 购物车id
        $car_id = array_column($carInfo,'car_id');
        // dd($car_id);
        $checkedbuynunber = array_combine($car_id,$buy_number);
        // dd($checkedbuynunber);
        // 总价
        $totalprice = array_sum(array_column($carInfo,'price'));
        // dd($totalprice);

        return view("index.car",compact('carInfo','count','checkedbuynunber','totalprice'));
    }

    // 结算
    public function carpay($id){
        // 取出用户id
        $user_id = session('member')->member_id;
        // dd($member_id);
        $car = \DB::select("select *,buy_number*goods_price as price from car where user_id=?",[$user_id]);
        // dd($carInfo);

        // 每个商品的购买数量
        $buy_number = array_column($car,'buy_number');
        // dd($count);

        //总商品购买数量
        $count = array_sum($buy_number);
        // dd($count);

        // 购物车id
        $car_id = array_column($car,'car_id');
        // dd($car_id);
        $checkedbuynunber = array_combine($car_id,$buy_number);
        // dd($checkedbuynunber);
        // 总价
        $totalprice = array_sum(array_column($car,'price'));
        // dd($totalprice);



        $carInfo = Car::all();
        // dd($carInfo);
        return view("index.pay",['carInfo'=>$carInfo,'buy_number'=>$buy_number,'totalprice'=>$totalprice,'checkedbuynunber'=>$checkedbuynunber]);
        // echo $id;
        

       
    }


}
