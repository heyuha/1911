<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 基本的表格</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
   <div class="container-fluid">
   <div class="navbar-header">
      <a class="navbar-brand" href="#">微商城</a>
   </div>
   <div>
      <ul class="nav navbar-nav">
         <li class="active"><a href="{{url('brand/')}}">商品品牌</a></li>
         <li><a href="{{url('cate/')}}">商品分类</a></li>
         <li><a href="{{url('goods/')}}">商品管理</a></li>
         <li><a href="{{url('admin/')}}">管理员管理</a></li>
      </ul>
   </div>
   </div>
</nav>
<form action="">
   品牌名称<input type="text" value="{{$brand_name}}" name="brand_name">
   <input type="submit" value="搜索">
</form>
<table class="table">
	<caption>品牌展示页面</caption>
   <thead>
      <tr>
         <th>品牌ID</th>
         <th>品牌名称</th>
         <th>品牌网址</th>
         <th>品牌logo</th>
         <th>品牌介绍</th>
         <th>操作</th>
      </tr>
   </thead>
   <tbody>
     @foreach($brand as $k=>$v)
      <tr>
         <td>{{$v->brand_id}}</td>
         <td>{{$v->brand_name}}</td>
         <td>{{$v->brand_url}}</td>
         <td>
            @if($v->brand_logo)
               <img src="{{env('UPLOADS_URL')}}{{$v->brand_logo}}" width="50px">
            @endif
         </td>
         <td>{{$v->brand_desc}}</td>
         <td>
            <a href="{{url('brand/destroy/'.$v->brand_id)}}">删除</a>
            <a href="{{url('brand/edit/'.$v->brand_id)}}">修改</a>
         </td>
      </tr>
      @endforeach
      <tr>
         <td colspan="5" align="center">{{$brand->appends(['brand_name'=>$brand_name])->links()}}</td>
      </tr>
   </tbody>
</table>
<script>
   // 无刷新分页
   $(document).on('click','.page-item a',function(){
      // alert(123);
      var url=$(this).attr('href');

      $.get(url,function(res){
         // console.log(res);
         $('tbody').html(res);
      })

      return false;
   })
</script>
</body>
</html>