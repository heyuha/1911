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

<form class="form-horizontal" role="form" action="{{url('cate/store')}}" method="post">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="cate_name">
			<span></span>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">父级分类</label>
		<select name="p_id">
		      <option value="">请选择</option>
		      @foreach($cate as $k=>$v)
		      <option value="{{$v->cate_id}}">{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
		      @endforeach
   		 </select>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		 <label class="checkbox-inline">
        	<input type="radio" id="inlineCheckbox1" name="is_show" value="1" checked>是
	    </label>
	    <label class="checkbox-inline">
	        <input type="radio" id="inlineCheckbox2" name="is_show" value="2">否
	    </label>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否在导航栏显示</label>
		 <label class="checkbox-inline">
        	<input type="radio" id="inlineCheckbox1" name="is_nav_show" value="1" checked>是
	    </label>
	    <label class="checkbox-inline">
	        <input type="radio" id="inlineCheckbox2" name="is_nav_show" value="2">否
	    </label>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类简介</label>
		<div class="col-sm-10">
			<textarea name="cate_desc" id="" cols="30" rows="10"></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>
	<script>
		$("input[name='cate_name']").blur(function(){
			// alert(1111)
			var cate_name=$(this).val();
			// alert(brand_name)
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
			$.ajax({
				type:"post",
				url:"{{url('/cate/checkName')}}",
				data:{cate_name:cate_name},
				success:function(res){
					if(res>0){
						$("input[name='cate_name']").next().text('分类名称已存在');
					}
				}
			})
		})
	</script>
</body>
</html>