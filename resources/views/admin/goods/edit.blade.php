<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>后台品牌</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

	<!-- @if ($errors->any()) <div class="alert alert-danger"> <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul> </div> @endif -->

<form class="form-horizontal" role="form" action="{{url('goods/update/'.$goods->goods_id)}}" method="post" enctype="multipart/form-data"> 
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" value="{{$goods->goods_name}}" name="goods_name">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" value="{{$goods->goods_no}}" name="goods_no">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" value="{{$goods->goods_price}}" name="goods_price">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="firstname" name="goods_img">
			<span><img src="{{env('UPLOADS_URL')}}{{$goods->goods_img}}" width="80px"></span>
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
			<input type="text" class="form-control" id="firstname" value="{{$goods->goods_num}}" name="goods_num">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<select name="cate_id">
		      <option value="">请选择</option>
		      @foreach($cate as $k=>$v)
		      <option value="{{$v->cate_id}}" @if($v->cate_id==$goods->cate_id)selected @endif>{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
		      @endforeach
   		 </select>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">所属品牌</label>
		<select name="brand_id">
		      <option value="">请选择</option>
		      @foreach($brand as $k=>$v)
		      <option value="{{$v->brand_id}}" @if($v->brand_id==$goods->brand_id)selected @endif>{{$v->brand_name}}</option>
		      @endforeach
   		 </select>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否精品</label>
		 <label class="checkbox-inline">
        	<input type="radio" id="inlineCheckbox1" name="is_best" value="1"  @if($goods->is_best==1)checked @endif>是
	    </label>
	    <label class="checkbox-inline">
	        <input type="radio" id="inlineCheckbox2" name="is_best" value="2"  @if($goods->is_best==2)checked @endif>否
	    </label>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否幻灯片展示</label>
		 <label class="checkbox-inline">
        	<input type="radio" id="inlineCheckbox1" name="is_slide" value="1"   @if($goods->is_slide==1)checked @endif>是
	    </label>
	    <label class="checkbox-inline">
	        <input type="radio" id="inlineCheckbox2" name="is_slide" value="2"   @if($goods->is_slide==2)checked @endif>否
	    </label>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否热卖</label>
		 <label class="checkbox-inline">
        	<input type="radio" id="inlineCheckbox1" name="is_hot" value="1"   @if($goods->is_hot==1)checked @endif>是
	    </label>
	    <label class="checkbox-inline">
	        <input type="radio" id="inlineCheckbox2" name="is_hot" value="2"   @if($goods->is_hot==2)checked @endif>否
	    </label>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否展示</label>
		 <label class="checkbox-inline">
        	<input type="radio" id="inlineCheckbox1" name="is_show" value="1"   @if($goods->is_show==1)checked @endif>是
	    </label>
	    <label class="checkbox-inline">
	        <input type="radio" id="inlineCheckbox2" name="is_show" value="2"   @if($goods->is_show==2)checked @endif>否
	    </label>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品介绍</label>
		<div class="col-sm-10">
			<textarea name="goods_desc" id="" cols="30" rows="10">{{$goods->goods_desc}}</textarea>
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