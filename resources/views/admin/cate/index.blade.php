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
         <li><a href="{{url('brand/')}}">商品品牌</a></li>
         <li class="active"><a href="{{url('cate/')}}">商品分类</a></li>
         <li><a href="{{url('goods/')}}">商品管理</a></li>
         <li><a href="{{url('admin/')}}">管理员管理</a></li>
      </ul>
   </div>
   </div>
</nav>
<table class="table">
	<caption>后台分类展示页面</caption>
   <thead>
      <tr>
         <th>分类id</th>
         <th>分类名称</th>
         <th>是否展示</th>
         <th>是否在导航栏展示</th>
         <th>分类介绍</th>
         <th>操作</th>
      </tr>
   </thead>
   <tbody>
     @foreach($cate as $k=>$v)
      <tr>
         <td>{{$v->cate_id}}</td>
         <td>{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</td>
         <td>@if($v->is_show==1)是@endif @if($v->is_show==2)否@endif</td>
         <td>@if($v->is_nav_show==1)是@endif @if($v->is_nav_show==2)否@endif</td>
         <td>{{$v->cate_desc}}</td>
         <td>
            <a href="javascript:void(0)" id="{{$v->cate_id}}" class="btn btn-danger">删除</a>
            <a href="{{url('cate/edit/'.$v->cate_id)}}">修改</a>
         </td>
      </tr>
      @endforeach
      <tr>
      </tr>
   </tbody>
</table>
<script>
   $('.btn-danger').click(function(){
      var cate_id=$(this).attr('id');
      // alert(cate_id)
      if(window.confirm("您确定要删除吗?")){
         $.get('/cate/destroy/'+cate_id,function(res){
            location.href="/cate";
            // alert(res)
         },'json');
      }
   })
</script>
</body>
</html>