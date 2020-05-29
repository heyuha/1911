<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>后台品牌</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

	<!-- @if ($errors->any()) <div class="alert alert-danger"> <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul> </div> @endif -->

<form class="form-horizontal" role="form" action="{{url('brand/store')}}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="brand_name">
			<b style="color:red">{{$errors->first('brand_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="brand_url">
			<b style="color:red">{{$errors->first('brand_url')}}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌logo</label>
		<div class="col-sm-10">
			<input type="file"  id="lastname" name="brand_logo">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌简介</label>
		<div class="col-sm-10">
			<textarea name="brand_desc" id="" cols="30" rows="10"></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>
	<script>
		$("input[name='brand_name']").blur(function(){
			// alert(1111)
			var brand_name=$(this).val();
			// alert(brand_name)
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
			$.ajax({
				type:"post",
				url:"{{url('/brand/checkName')}}",
				data:{brand_name:brand_name},
				success:function(res){
					if(res>0){
						$("input[name='brand_name']").next().text('品牌名称已存在');
					}
				}
			})
		})
		

	</script>
</body>
</html>