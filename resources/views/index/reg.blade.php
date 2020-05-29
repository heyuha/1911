  @extends('layouts.shop')
@section('title', '前台注册')
@section('content')
 <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
    
     <form action="{{url('login/regstore')}}" method="post" class="reg-login">
    <b style="color:red">{{session('msg')}}</b>
      @csrf

      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="name" placeholder="输入手机号码或者邮箱号" />
      <b style="color:red">{{$errors->first('name')}}</b>
       </div>
       <div class="lrList2"><input type="text" name="code" placeholder="输入短信验证码" /> 
        
        <button type="button">获取验证码</button>

      </div>
      <b style="color:red">{{$errors->first('code')}}</b>
       <div class="lrList"><input type="password" name="pwd" placeholder="设置新密码（6-18位数字或字母）" />
        <b style="color:red">{{$errors->first('pwd')}}</b></div>
       <div class="lrList"><input type="password" name="repwd" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <script>
        $("button").click(function(){
            var name = $("input[name='name']").val();
            var reg = /^1[3|5|6|7|8|9]\d{9}$/;

            // 手机号发送验证码
            if(reg.test(name)){
            // 手机号发送验证码
            $.get('/login/sendSms',{name:name},function(res){
                alert(res.msg)
            },'json');
            return false;
          }

          // 邮箱验证规则
          var emailreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
          if(emailreg.test(name)){
            // 邮箱发送邮件
            $.get('/login/sendEmail',{email:name},function(res){
                alert(res.msg);
            },'json');
            return false;
          }

            alert("请输入正确的手机号或者邮箱");

        })


        $("input[name='name']").blur(function(){
            var name = $(this).val();
            $.get('/login/checkName',{name:name},function(res){
              if(res>0){
                alert('账号已存在');
              }
            })
        })
     </script>
     @endsection