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