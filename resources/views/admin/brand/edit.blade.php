<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>后台品牌修改页面</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<form class="form-horizontal" role="form" action="{{url('brand/update/'.$brand->brand_id)}}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" value="{{$brand->brand_name}}" name="brand_name">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" value="{{$brand->brand_url}}"  name="brand_url">
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌logo</label>
		<div class="col-sm-10">
			<input type="file"  id="lastname" name="brand_logo">@if($brand->brand_logo)
			<img src="{{env('UPLOADS_URL')}}{{$brand->brand_logo}}" width="80px">
		@endif
		</div>
		
	</div>
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌简介</label>
		<div class="col-sm-10">
			<textarea name="brand_desc" id="" cols="30" rows="10">{{$brand->brand_desc}}</textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">编辑</button>
		</div>
	</div>
</form>

</body>
</html>