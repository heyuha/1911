<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Car;

class OrderController extends Controller
{
    public function order(){
    	$orderInfo = Car::all();
    	// dd($orderInfo);
    	// 生成随机的订单号
    	$order_no = rand(10,99).date('ymdhis').rand(100,999);
    	$order_on = rand(10,99).date('ymdhis').rand(100,999);
    	// dd($order_on);
    	return view("index.success",['orderInfo'=>$orderInfo,'order_no'=>$order_no,'order_on'=>$order_on]);
    }
}
