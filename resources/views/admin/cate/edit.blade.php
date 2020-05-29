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



<form class="form-horizontal" role="form" action="{{url('cate/update/'.$post->cate_id)}}" method="post">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" value="{{$post->cate_name}}" name="cate_name">
			<b style="color:red">{{$errors->first('cate_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">父级分类</label>
		<select name="p_id">
		      <option value="0">请选择</option>
		      @foreach($cate as $k=>$v)
		      <option value="{{$v->cate_id}}" @if($v->cate_id==$post->cate_id)selected @endif>{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
		      @endforeach
   		 </select>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		 <label class="checkbox-inline">
        	<input type="radio" id="inlineCheckbox1" name="is_show" value="1" @if($post->is_show==1)checked @endif>是
	    </label>
	    <label class="checkbox-inline">
	        <input type="radio" id="inlineCheckbox2" name="is_show" value="2" @if($post->is_show==2)checked @endif>否
	    </label>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否在导航栏显示</label>
		 <label class="checkbox-inline">
        	<input type="radio" id="inlineCheckbox1" name="is_nav_show" value="1" @if($post->is_nav_show==1)checked @endif>是
	    </label>
	    <label class="checkbox-inline">
	        <input type="radio" id="inlineCheckbox2" name="is_nav_show" value="2" @if($post->is_nav_show==2)checked @endif>否
	    </label>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类简介</label>
		<div class="col-sm-10">
			<textarea name="cate_desc" id="" cols="30" rows="10">{{$post->cate_desc}}</textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>