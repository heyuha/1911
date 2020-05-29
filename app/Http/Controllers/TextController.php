<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextController extends Controller
{
	// 首页展示
    public function index(){
    	echo "index首页";
    }

    // 添加
    public function add(){
    	return  view("add");
    }

    // 执行添加
    public function adddo(Request $request){
    	// echo "跳转了";
        // 接受全部值
        //$post = $request->all();
        // $post = $request->post();
        // $post = $request->input();
        // dump($post);

        // 只接受一个值
        // $name = $request->name;
        // $name = $request->input('name');
        // $name = $request->post('name');
        // dd($name);

        // 排除接受***
        $post = $request->except(['name','_token']);
        dump($post);

        // 只接受***
        $post = $request->only(['name','pwd']);
        dd($post);
    }


    public function goods($id,$name){
        echo $id.'-'.$name;
    }

    public function show($id=0){
        echo $id;
    }

    public function detail($id,$name=null){
        echo $id.'-'.$name;
    }


}
