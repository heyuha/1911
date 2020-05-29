<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 基本表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<form role="form" action="{{url('admin/update/'.$admin->admin_id)}}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="name">账号</label>
		<input type="text" class="form-control" value="{{$admin->admin_name}}" name="admin_name" id="name" 
			   placeholder="请输入名称">
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员头像</label>
		<div class="col-sm-10">
			<input type="file"  id="lastname" name="admin_logo">
		</div>
	</div>
	<div class="form-group">
		<label for="name">邮箱</label>
		<input type="text" class="form-control" name="admin_email" value="{{$admin->admin_email}}" id="name" 
			   placeholder="请输入邮箱">
	</div>
	<div class="form-group">
		<label for="name">手机号</label>
		<input type="text" class="form-control" name="admin_tel" value="{{$admin->admin_tel}}" id="name" 
			   placeholder="请输入手机号">
	</div>
	<div class="form-group">
		<label for="name">密码</label>
		<input type="password" class="form-control" name="admin_pwd" value="{{$admin->admin_pwd}}" id="name" 
			   placeholder="请输入密码">
	</div>
	
	<button type="submit" class="btn btn-default">编辑</button>
</form>
	
</body>
</html>