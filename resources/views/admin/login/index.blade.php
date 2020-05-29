<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>微商城后台登录</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

	<!-- @if ($errors->any()) <div class="alert alert-danger"> <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul> </div> @endif -->

<form class="form-horizontal" role="form" action="{{url('login/logindo')}}" method="post" >
	<b style="color:red">{{session('msg')}}</b>
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">账号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="admin_name">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="firstname" name="admin_pwd">
		</div>
	</div class="form-group">
	  <div class="checkbox">
    <label  for="firstname" class="col-sm-2 control-label">
      <input type="checkbox" name="isrember">七天免登录
    </label>
  </div>
	
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>