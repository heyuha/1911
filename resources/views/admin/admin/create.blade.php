<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 基本表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<form role="form" action="{{url('admin/store')}}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="name">账号</label>
		<input type="text" class="form-control" name="admin_name" id="name" 
			   placeholder="请输入名称">
			   <span style="color:red"></span>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员头像</label>
		<div class="col-sm-10">
			<input type="file"  id="lastname" name="admin_logo">
		</div>
	</div>
	<div class="form-group">
		<label for="name">邮箱</label>
		<input type="text" class="form-control" name="admin_email" id="name" 
			   placeholder="请输入邮箱">
	</div>
	<div class="form-group">
		<label for="name">手机号</label>
		<input type="text" class="form-control" name="admin_tel" id="name" 
			   placeholder="请输入手机号">
	</div>
	<div class="form-group">
		<label for="name">密码</label>
		<input type="password" class="form-control" name="admin_pwd" id="name" 
			   placeholder="请输入密码">
	</div>
	
	<button type="submit" class="btn btn-default">提交</button>
</form>
	<script>
		$("input[name='admin_name']").blur(function(){
			// $(this).next().empty();
			var admin_name=$(this).val();
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
			$.ajax({
				type:"post",
				url:"{{url('/admin/checkName')}}",
				data:{admin_name:admin_name},
				success:function(res){
					if(res>0){
						$("input[name='admin_name']").next().text('账号已存在');
					}
				}
			})
		})
	</script>
</body>
</html>