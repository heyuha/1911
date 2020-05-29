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
         <li><a href="{{url('cate/')}}">商品分类</a></li>
         <li><a href="{{url('goods/')}}">商品管理</a></li>
         <li class="active"><a href="{{url('admin/')}}">管理员管理</a></li>
      </ul>
   </div>
   </div>
</nav>
<table class="table">
	<caption>管理员管理展示页面</caption>
   <thead>
      <tr>
         <th>管理员ID</th>
         <th>管理员头像</th>
         <th>管理员名称</th>
         <th>管理员手机号</th>
         <th>管理员邮箱</th>
         <th>操作</th>
      </tr>
   </thead>
   <tbody>
      @foreach($admin as $k=>$v)
      <tr>
         <td>{{$v->admin_id}}</td>
         <td>
            @if($v->admin_logo)
               <img src="{{env('UPLOADS_URL')}}{{$v->admin_logo}}" width="50px">
            @endif
         </td>
         <td>{{$v->admin_name}}</td>
         <td>{{$v->admin_tel}}</td>
         <td>{{$v->admin_email}}</td>
         <td>
            <a href="{{url('admin/destroy/'.$v->admin_id)}}">删除</a>
            <a href="{{url('admin/edit/'.$v->admin_id)}}">修改</a>
         </td>
      </tr>
      @endforeach    
      <tr>
         <td colspan="5" align="center">{{$admin->links()}}</td>
      </tr> 
   </tbody>
   
</table>
<script>
   // 无刷新分页
   $(document).on('click','.page-item a',function(){
      var url = $(this).attr('href');
      // alert(url);
      $.get(url,function(res){
         $('tbody').html(res);
      })

      return false;
   })
</script>
</body>
</html>