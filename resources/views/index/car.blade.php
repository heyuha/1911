@extends('layouts.shop')
@section('title', '购物车列表')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
@csrf
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
   
     
     <div class="dingdanlist">
      <table>
        @foreach($carInfo as $k=>$v)

        @if($k==0)
       <tr>
        <td width="100%" colspan="4">
          <a href="javascript:;"><input id="boxs" type="checkbox" name="1" /> 全选
          </a>
        </td>
       </tr>
       @endif
       <tr car_id="{{$v->car_id}}">
        <td width="4%"><input type="checkbox"  class="box" /></td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{date('Y-m-d H:i:s',$v->addtime)}}</time>
        </td>
        <td align="right"><input type="text" id="buy_{{$v->car_id}}" value="{{$v->car_id}}" class="spinnerExample" /></td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->goods_price}}</strong></th>
       </tr>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 删除</a></td>
       </tr>
        
       @endforeach
       <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">¥{{$totalprice}}</strong></td>
       <td width="40%"><a href="{{url('/car/carpay/'.$v->car_id)}}" class="jiesuan">去结算</a></td>
      </tr>
      
      </table>
     </div><!--dingdanlist/-->

<script>
 // $(document).on('click','.jiesuan',function(){
 //        // alert(123)
 //        // 获取选中的复选框
 //        var _box=$(".box:checked");
 //        var car_id = "";
 //         _box.each(function(index){
 //            car_id +=$(this).parents("tr").attr("car_id")+",";
 //        })
 //         // console.log(car_id);
 //         // return/
 //        // 处理goods——id右边多余的特殊符号
 //        car_id = car_id.substr(0,car_id.length-1);
 //        // // console.log(car_id)
 //        //  location.href="/car/carpay?car_id="+car_id;
 //        // $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
 //       $.ajax({
 //        type:"get",
 //        url:"{{url('car/carpay')}}",
 //        data:{car_id:car_id},
 //        success:function(res){
 //          console.log(res)
 //        }
 //      })
 // })
</script>
@endsection