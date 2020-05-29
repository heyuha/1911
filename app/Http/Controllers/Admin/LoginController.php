<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    public function index(){
    	return view('admin.login.index');
    }
    public function logindo(Request $request){
    	$post = $request->except("_token");
        if(!$post['admin_name']){
            return redirect("/login")->with('msg','账号不可为空');
        }
        if(!$post['admin_pwd']){
            return redirect("/login")->with('msg','密码不可为空');
        }

    	$adminuser = Admin::where('admin_name',$post['admin_name'])->first();
        if(!$adminuser){
            return redirect("/login")->with('msg','账号或密码输入错误！');
        }   
    	if(decrypt($adminuser->admin_pwd)!=$post['admin_pwd']){
    		// echo "密码不同";
    		return redirect("/login")->with('msg','账号或密码输入错误！');
    	}

        // 七天免登录
        if(isset($post['isrember'])){
            // 有值存cookie
            Cookie::queue('adminInfo',serialize($adminuser),60*7*24);
        }

    	session(['adminInfo'=>$adminuser]);
    	return redirect("/goods");
    }

    public function getcookie(){
        // 两种获取cookie的方法
        // echo request()->cookie('name');
        echo Cookie::get("name");
    }

    public function setcookie(){
        // 三种设置cookie的方式
        // return response('哇康木图河北')->cookie('name','贺宇豪',1);
        // Cookie::queue(Cookie::make('name','沙河地铁',1));
        Cookie::queue("name",'河北',1);
    }

    // 退出登录
    public function logout(Request $request){
        $request->session()->flush();
        return redirect("/login");
    }


}
