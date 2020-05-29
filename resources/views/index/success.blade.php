@extends('layouts.shop')
@section('title','确认结算')
@section('content')
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="susstext">订单提交成功</div>
     <div class="sussimg">&nbsp;</div>
     <div class="dingdanlist">
      <table>
        @foreach($orderInfo as $k=>$v)
       <tr>
        <td width="50%">
         <h3>订单号：{{$order_no}}</h3>
         <time>创建日期：{{date('Y-m-d H:i:s',$v->addtime)}}<br />
</time>
         <strong class="orange">¥{{$v->goods_price}}</strong>
        </td>
        <td align="right"><span class="orange">等待支付</span></td>
       </tr>
       @endforeach
      </table>
     </div><!--dingdanlist/-->
     <div class="succTi orange">请您尽快完成付款，否则订单将被取消</div>
     
    </div><!--content/-->
    
  
       <td width="50%"><a href="prolist.html" class="jiesuan" style="background:#5ea626;">继续购物</a></td>
       <td width="50%"><a href="success.html" class="jiesuan">立即支付</a></td>

  @endsection