<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\StoreCatePost;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cate;
use DB;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



//         // session的应用
//         // 存储
//         request()->session()->put("name",'heyuhao');
//         session(['class'=>'1911']);
//         // /获取
//         echo request()->session()->get("name");
//         echo session('class');

//         // 获取所有的session
//         dump(request()->session()->all());

//         // 删除
//         request()->session()->forget('name');
//         session(['class'=>null]);

//         dump(request()->session()->get("class"));
//         dump(request()->session()->get("name"));

//         // 判断session里是否有此键
//         dump(request()->session()->has('name'));
//         dump(request()->session()->exists('name'));

// die;

        $cate = Cate::get();
        // 调用无限极分类
        $cate = createTree($cate);
        return view("admin.cate.index",['cate'=>$cate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Cate::all();
        $cate=createTree($cate);
        return view("admin.cate.create",['cate'=>$cate]);
    }

   public function checkName(){
        $cate_name = request()->cate_name;
        // echo $brand_name;
        // echo $goods_name;
        $count = Cate::where('cate_name',$cate_name)->count();
        echo $count;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post = $request->except('_token');
        // dd($post);
        $res = Cate::create($post);
        if($res){
            return redirect('cate/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Cate::where('cate_id',$id)->first();
        // dd($post);
        $cate = Cate::all();
        $cate = createTree($cate);
        return view("admin.cate.edit",['cate'=>$cate,'post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCatePost $request, $id)
    {
        $post = $request->except("_token");
        // dd($post);
        $res = Cate::where('cate_id',$id)->update($post);
        if($res!==false){
            return redirect("/cate");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // echo $id;
        $res = Cate::where('cate_id',$id)->delete();
        if($res){
            echo json_encode(['code'=>'00000','msg'=>"删除成功"]);die;
        }
    }
}
