<?php

namespace App\Http\Controllers\Index;
use App\Mail\SendCodeEmail;
use Illuminate\Support\Facades\Mail;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Login;
use App\Member;
use App\Http\Requests\StoreRegPost;
use  App\Http\Requests\StoreLoginPost;
use App\Goods;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
class LoginController extends Controller
{
    public function login(){
    	return view("index.login");
    }

    // 手机号发送短信验证码
    public function sendSms(Request $request){
    	// 接值
    	$name = $request->name;
    	$reg = '/^1[3|5|6|7|8|9]\d{9}$/';
		if(!preg_match($reg,$name)){
			echo json_encode(['code'=>'00001','msg'=>"手机号格式不正确"]);die;
		}
		// 生成随机验证码
		$code = rand(100000,999999);
		// echo $code;
		$res = $this->SendByMobile($name,$code);
		if($res['Message']=="OK"){
			session(['code_'.$name=>$code]);
			request()->session()->save();
			echo json_encode(['code'=>'00000','msg'=>"发送成功"]);die;
		}else{
			echo json_encode(['code'=>'00001','msg'=>"发送失败"]);die;
		}
    } 

    // 手机号发送短信验证码
    public function SendByMobile($name,$code){
		// Download：https://github.com/aliyun/openapi-sdk-php
		// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md
		AlibabaCloud::accessKeyClient('LTAI4Fpn8d2VBz4Tx5BVApqV', '3DGzDSaCcyYcYxH80LJapEgDjSobh5')
		                        ->regionId('cn-hangzhou')
		                        ->asDefaultClient();
		try {
		    $result = AlibabaCloud::rpc()
		                          ->product('Dysmsapi')
		                          // ->scheme('https') // https | http
		                          ->version('2017-05-25')
		                          ->action('SendSms')
		                          ->method('POST')
		                          ->host('dysmsapi.aliyuncs.com')
		                          ->options([
		                                        'query' => [
		                                          'RegionId' => "cn-hangzhou",
		                                          'PhoneNumbers' => $name,
		                                          'SignName' => "宇豪影视",
		                                          'TemplateCode' => "SMS_185241548",
		                                          'TemplateParam' => "{code:$code}",
		                                        ],
		                                    ])
		                          ->request();
		    return $result->toArray();
		} catch (ClientException $e) {
		    return $e->getErrorMessage() . PHP_EOL;
		} catch (ServerException $e) {
		    return $e->getErrorMessage() . PHP_EOL;
		}
	}


    public function reg(){
    	return view("index.reg");
    }

    // 邮箱发送邮件
    public function sendEmail(Request $request){
    	$email = $request->email;
    	// 正则验证邮箱格式是否正确
    	$reg = '/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/';
    	if(!preg_match($reg,$email)){
    		echo json_encode(['code'=>'00001','msg'=>'邮箱格式不正确']);die;
    	}
    	// 随机生成邮箱验证码
    	$code = rand(100000,999999);

    	// 发送
		$res = $this->sendByEmail($email,$code);
    	session(['code_'.$email=>$code]);
    	$request->session()->save();
    	echo json_encode(['code'=>'00000','msg'=>'发送成功']);die;
    }

    // 使用邮箱发送短信验证码
	public function sendByEmail($email,$code){
		Mail::to($email)->send(new SendCodeEmail($code));
	}


    // 注册添加
    public function regstore(StoreRegPost $request){
    	$post = $request->except("_token");
    	// dump($request->session()->all());
    	// dd($request->session()->get('code_'.$post['name']));
    	if($post['code']!=$request->session()->get('code_'.$post['name'])){
    		return redirect('/login/reg')->with('msg','您的验证码有误');die;
    	}
    	// dd($post);
    	if($post['pwd']!=$post['repwd']){
    		return redirect('/login/reg')->with('msg','用户名或密码不对！');die;
    	}
    	$post['pwd'] = encrypt($post['pwd']);
    	unset($post['repwd']);
    	$res = Member::create($post);
    	if($res){
    		return redirect('/login');
    	}
    }


    // 登录验证账号密码
	public function logindo(StoreLoginPost $request){
		$post = $request->except("_token");
		$memberInfo = Member::where('name',$post['name'])->first();
		// 判断密码是否正确
		if(decrypt($memberInfo['pwd'])!=$post['pwd']){
			// 账号或密码错误  跳转登录页面 并提示
			return redirect('/login')->with('msg','账号或密码有误！');die;
		}
		// echo "ok";
		session(['member'=>$memberInfo]);
		
		if($post['refer']){
    		return redirect($post['refer']);
    	}


		return redirect('/');
	}


	// 账号验证唯一性
	public function checkName(){
		$name = request()->name;
		// echo $name;
		$count = Member::where('name',$name)->count();
		echo $count;
	}

	// 商品详情页面
	public function proinfo($id){
		// $goods = Cache::get('goods_'.$id);/
		$goods = Redis::get("goods_".$id);
		// $goods = Goods::find($id);
		// dump($goods);
		if(!$goods){
			echo "db==";
			$goods = Goods::where('goods_id',$id)->first();
			// Cache::put('goods_'.$id,$goods,60);
			// cache(['goods_'.$id=>$goods],60);
			$goods = serialize($goods);

			Redis::setex('goods_'.$id,60,$goods);
		}

		$goods = unserialize($goods);
		$num = Redis::incr("num_".$id);
		// dd($num);
		
		// dd($goods);
		return view("index.proinfo",['goods'=>$goods,'num'=>$num]);
	}


}
