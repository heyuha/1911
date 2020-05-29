<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 基本的表格</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <meta name="csrf-token" content="{{ csrf_token() }}">
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
         <li class="active"><a href="{{url('goods/')}}">商品管理</a></li>
         <li><a href="{{url('admin/')}}">管理员管理</a></li>
         <li><a href="{{url('admin/')}}">欢迎[<span style="color=red">{{session('adminInfo')->admin_name}}</span>]登录</a></li>
         <li><a href="{{url('/logout')}}">退出登录</a></li>
      </ul>
   </div>
   </div>
</nav>
<table class="table">
	<caption>商品展示页面</caption>
   <form>
      分类名称<select name="cate_id">
         <option value="">请选择分类</option>
         @foreach($cate as $k=>$v)
         <option value="{{$v->cate_id}}" @if($cate_id==$v->cate_id)selected @endif>{{$v->cate_name}}</option>
         @endforeach
      
      品牌名称</select><select name="brand_id">
         <option value="">请选择品牌</option>
         @foreach($brand as $k=>$v)
         <option value="{{$v->brand_id}}" @if($brand_id==$v->brand_id)selected @endif>{{$v->brand_name}}</option>
         @endforeach
      </select>
      商品名称<input type="text" value="{{$goods_name}}" name="goods_name">
      商品价格
      <input type="text" name="min" value="{{$min}}">-
      <input type="text" name="max" value="{{$max}}">
      <input type="submit" value="搜索">
   </form>
   <thead>
      <tr>
            <th>商品id</th>
            <th>商品名称</th>
            <th>商品货号</th>
            <th>商品价格</th>
            <th>商品图片</th>
            <th>商品相册</th>
            <th>商品库存</th>
            <th>分类名称</th>
            <th>所属品牌</th>
            <th>是否精品</th>
            <th>是否热卖</th>
            <th>是否显示</th>
            <th>是否幻灯片展示</th>
            <th>商品介绍</th>
            <th>操作</th>
      </tr>
   </thead>
   <tbody>
     @foreach($goods as $k=>$v)
      <tr>
            <td>{{$v->goods_id}}</td>
            <td>{{$v->goods_name}}</td>
            <td>{{$v->goods_no}}</td>
            <td>{{$v->goods_price}}</td>
            <td><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="80pxs" alt=""></td>
            <td>

               @if(isset($v->goods_imgs))
               @php $imgs = explode('|',$v->goods_imgs); @endphp
                     @foreach($imgs as $k=>$vv)
                        <img src="{{env('UPLOADS_URL')}}{{$vv}}" width="100px">
                     @endforeach
               @endif

            </td>
            <td>{{$v->goods_num}}</td>
            <td>{{$v->cate_name}}</td>
            <td>{{$v->brand_name}}</td>
            <td>@if($v->is_best==1)是@endif @if($v->is_best==2)否@endif</td>
            <td>@if($v->is_hot==1)是@endif @if($v->is_hot==2)否@endif</td>
            <td>@if($v->is_show==1)是@endif @if($v->is_show==2)否@endif</td>
            <td>@if($v->is_slide==1)是@endif @if($v->is_slide==2)否@endif</td>
            <td>{{$v->goods_desc}}</td>
            <td>
               <a class="btn btn-danger" href="javascript:void(0)" id="{{$v->goods_id}}"> 删除</a>
               <a href="{{url('/goods/edit/'.$v->goods_id)}}">修改</a>
            </td>
      </tr>
      @endforeach
      <tr>
         <td colspan="5" align="center">{{$goods->appends(['goods_name'=>$goods_name,'cate_id'=>$cate_id,'brand_id'=>$brand_id,'max'=>$max,'min'=>$min])->links()}}</td>
      </tr>
   </tbody>
</table>
<script>
   $('.btn-danger').click(function(){
         var id = $(this).attr('id');
         $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
         // alert(id)
         if(window.confirm('您确定删除此记录吗？')){
            $.ajax({
            url:"{{url('goods/destroy/')}}",
            type:"get",
            data:{id:id},
            dataType:'json',
            success:function(res){
               if(res.code==00000){
                  location.href="/goods";
               }
            }
         })
         }
         
   })
</script>
</body>
</html>