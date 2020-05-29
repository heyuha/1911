@extends('layouts.shop')
@section('title', '前台商品详情')
@section('content')

    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      <!-- <img src="/static/index/images/image1.jpg" /> -->
      @if(isset($goods->goods_imgs))
          @php $imgs=explode('|',$goods->goods_imgs);@endphp
            @foreach($imgs as $vv)
            <img src="{{env('UPLOADS_URL')}}{{$vv}}" width="100px">
            @endforeach
          @endif
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$goods->goods_price}}</strong></th>
       <td>
        <input type="text" id="buy_number" class="spinnerExample" />
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$goods->goods_name}}</strong>
        <p class="hui">{{$goods->goods_desc}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
      访问量 {{$num}}
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="/static/index/images/image4.jpg" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a class="addcar">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->

<script>
  $(".addcar").click(function(){
    // 获取到商品id
    var goods_id = {{$goods->goods_id}};
    // alert(goods_id)
    // 获取购买数量
    var buy_number = $("#buy_number").val();
    $.get('/car/caradd',{goods_id:goods_id,buy_number:buy_number},function(res){
      if(res.code==00001){
        alert("商品库存不足");
      }
      if(res.code==00000){
        alert('加入购物车成功');
        location.href="/car/carcar";
      }
      if(res.code==00002){
        alert("请先登录");
        location.href="/login?refer="+window.location.href;
      }
    },'json');
  })
</script>


   @endsection