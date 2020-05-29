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