<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Http\Requests\StoreBrandPost;
use Illuminate\Support\Facades\Cache;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        // 接受搜索的值
        $brand_name = request()->brand_name;
        // echo $brand_name;
       
        $pages = request()->page??1;
        // dd($pages);
        // // dump($pages);
        $brand = Cache::get('brand_'.$pages.'_'.$brand_name);

        if(!$brand){
            dump("DB===");

             $where = [];
            if($brand_name){
                $where[] = ['brand_name','like',"%$brand_name%"];
            }

            $page = config("app.pagesize");

            $brand = Brand::where($where)->paginate($page);     
            Cache::put("brand_".$pages.'_'.$brand_name,$brand,60);
        }
       


        // ajax分页
        if(request()->ajax()){
            return view('admin.brand.ajaxindex',['brand'=>$brand,'brand_name'=>$brand_name]);
        }

        return view("admin.brand.index",['brand'=>$brand,'brand_name'=>$brand_name]);
    }
    public function checkName(){
        $brand_name = request()->brand_name;
        // echo $brand_name;
        // echo $goods_name;
        $count = Brand::where('brand_name',$brand_name)->count();
        echo $count;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandPost $request)
    {

        // // 第一种表单验证
        // $validatedData = $request->validate(
        //     [ 
        //        'brand_name' => 'required|unique:brand', 
        //        'brand_url' => 'required', 
        //      ],[
        //         'brand_name.required'=>'品牌名称不可为空',
        //         'brand_name.unique'=>'品牌名称已存在',
        //         'brand_url.required'=>'品牌网址不可为空',
        //          ]);


        $post = $request->except('_token');

        // 文件上传
        if($request->hasFile('brand_logo')){
            $post['brand_logo'] = upload('brand_logo');
        }


        $res = Brand::create($post);
        if($res){
            return redirect("/brand");
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
        // echo $id;
        // dd($id);
        $brand = Brand::where('brand_id',$id)->first();
        // dd($brand);
        return view('admin.brand.edit',['brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = $request->except('_token');

        if($request->hasFile('brand_logo')){
            $post['brand_logo'] = upload('brand_logo');
        }

        // dd($post);
        $res = Brand::where('brand_id',$id)->update($post);
        // dd($res);
        if($res!==false){
            return redirect('/brand');
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
        $res = Brand::where('brand_id',$id)->delete();
        // dd($res);
        if($res){
            return redirect('/brand');
        }
    }
}
