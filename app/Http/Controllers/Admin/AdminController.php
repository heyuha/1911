<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Admin::paginate(3);

        // ajax分页
        if(request()->ajax()){
        	return view("admin.admin.ajaxindex",['admin'=>$admin]);
        }

        return view("admin.admin.index",['admin'=>$admin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.admin.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 接值
        $post = $request->except("_token");
        // dd($post);
        // 处理时间
        $post['add_time'] = time();
        $post['admin_pwd'] = encrypt($post['admin_pwd']);
        // 添加入库
        if($request->hasFile('admin_logo')){
            $post['admin_logo'] = $this->upload("admin_logo");
        }
        $res = Admin::create($post);
        // dd($res);
        if($res){
        	return redirect("admin/");
        }
    }

    // 上传图片
    public function upload($filename){
        if(request()->file($filename)->isValid()){
            $file = request()->$filename;
            $path = request()->$filename->store("uploads");
            return $path;
        }
        return "文件上传失败";
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
        $admin = Admin::where("admin_id",$id)->first();
        // dd($admin);
        return view("admin.admin.edit",['admin'=>$admin]);
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
        $post = $request->except("_token");
        if($request->hasFile('admin_logo')){
            $post['admin_logo'] = $this->upload("admin_logo");
        }
        $res = Admin::where("admin_id",$id)->update($post);
        if($res!==false){
        	return redirect("admin/");
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
        $res = Admin::where('admin_id',$id)->delete();
        if($res){
        	return redirect("admin/");
        }
    }
    public function checkName(){
        $goods_name = request()->admin_name;
        // echo $goods_name;
        $count = Admin::where('admin_name',$goods_name)->count();
        echo $count;
    }
}
