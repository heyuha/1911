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

<form class="form-horizontal" role="form" action="{{url('goods/store')}}" method="post" enctype="multipart/form-data"> 
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="goods_name">
			<b style="color:red">{{$errors->first('goods_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="goods_no">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="goods_price">
			<b style="color:red">{{$errors->first('goods_price')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="firstname" name="goods_img">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="firstname" multiple="multiple" name="goods_imgs[]">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="goods_num">
			<b style="color:red">{{$errors->first('goods_num')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<select name="cate_id">
		      <option value="">请选择</option>
		      @foreach($cate as $k=>$v)
		      <option value="{{$v->cate_id}}">{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
		      @endforeach
   		 </select>
   		 <b style="color:red">{{$errors->first('cate_id')}}</b>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">所属品牌</label>
		<select name="brand_id">
		      <option value="">请选择</option>
		      @foreach($brand as $k=>$v)
		      <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
		      @endforeach
   		 </select>
   		 <b style="color:red">{{$errors->first('brand_id')}}</b>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否精品</label>
		 <label class="checkbox-inline">
        	<input type="radio" id="inlineCheckbox1" name="is_best" value="1" checked>是
	    </label>
	    <label class="checkbox-inline">
	        <input type="radio" id="inlineCheckbox2" name="is_best" value="2">否
	    </label>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否幻灯片展示</label>
		 <label class="checkbox-inline">
        	<input type="radio" id="inlineCheckbox1" name="is_slide" value="1" >是
	    </label>
	    <label class="checkbox-inline">
	        <input type="radio" id="inlineCheckbox2" name="is_slide" value="2" checked>否
	    </label>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否热卖</label>
		 <label class="checkbox-inline">
        	<input type="radio" id="inlineCheckbox1" name="is_hot" value="1" checked>是
	    </label>
	    <label class="checkbox-inline">
	        <input type="radio" id="inlineCheckbox2" name="is_hot" value="2">否
	    </label>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否展示</label>
		 <label class="checkbox-inline">
        	<input type="radio" id="inlineCheckbox1" name="is_show" value="1" checked>是
	    </label>
	    <label class="checkbox-inline">
	        <input type="radio" id="inlineCheckbox2" name="is_show" value="2" >否
	    </label>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品介绍</label>
		<div class="col-sm-10">
			<textarea name="goods_desc" id="" cols="30" rows="10"></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>
	<script>
		$("input[name='goods_name']").blur(function(){
			// alert(1111)
			var goods_name=$(this).val();
			// alert(goods_name)
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
			$.ajax({
				type:"post",
				url:"{{url('/goods/checkName')}}",
				data:{goods_name:goods_name},
				success:function(res){
					if(res>0){
						$("input[name='goods_name']").next().text('商品名称已存在');
					}
				}
			})
		})
	</script>
</body>
</html>