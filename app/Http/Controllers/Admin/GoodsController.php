<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\StoreGoodsPost;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Cate;
use App\Goods;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // 接受搜索的值
        $cate_id = request()->cate_id;
        // dump($cate_id);
        $brand_id = request()->brand_id;
        $goods_name = request()->goods_name;

        $min = request()->min;
        $max = request()->max;

        $where = [];

        if($cate_id){
            $where[] = ['goods.cate_id',$cate_id];
        }
        if($brand_id){
            $where[] = ['goods.brand_id',$brand_id];
        }
        if($goods_name){
            $where[] = ['goods_name','like',"%$goods_name%"];
        }
        if($min){
            $where[] = ['goods.goods_price','>=',$min];
        }
        if($max){
            $where[] = ['goods.goods_price','<=',$max];
        }


        // 获取品牌表数据
        $brand = Brand::all();
        // 获取分类表数据
        $cate = Cate::all();
        // dump($cate);
        $cate = createTree($cate);

        // 获取配置文件的偏移量
        $pagesize = config("app.pagesize");

        // 根据商品表品牌表分类表 三表联查
        $goods = Goods::select('goods.*','category.cate_name','brand.brand_name')
                        ->leftjoin('category','goods.cate_id','=','category.cate_id')
                        ->leftjoin('brand','goods.brand_id','=','brand.brand_id')
                        ->where($where)
                        ->paginate($pagesize);
        // dd($goods);
        return view("admin.goods.index",['goods'=>$goods,'cate'=>$cate,'brand'=>$brand,'cate_id'=>$cate_id,'brand_id'=>$brand_id,'goods_name'=>$goods_name,'min'=>$min,'max'=>$max]);
    }

    public function checkName(){
        $goods_name = request()->goods_name;
        // echo $brand_name;
        // echo $goods_name;
        $count = Goods::where('goods_name',$goods_name)->count();
        echo $count;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 获取品牌表数据
        $brand = Brand::all();
        // 获取分类表数据
        $cate = Cate::all();
        // dump($cate);
        $cate = createTree($cate);
        // dd($cate);
        return view("admin.goods.create",['brand'=>$brand,'cate'=>$cate]);
    }


    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoodsPost $request)
    {


        $post = $request->except("_token");
        // dd($post);
        // 处理图片
        if($request->hasFile('goods_img')){
            $post['goods_img'] = upload("goods_img");
        }
        // 多文件上传
        if(isset($post['goods_imgs'])){
            $post['goods_imgs'] = moreupload("goods_imgs");
            $post['goods_imgs'] = implode("|",$post['goods_imgs']);
        }
        // dd($post);
        // 添加入库
        $res = Goods::create($post);
        // dd($res);
        if($res){
            return redirect("goods/");
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
        $goods = Goods::where('goods_id',$id)->first();
        // dd($goods);
        $cate = Cate::all();
        $cate = createTree($cate);
        // dd($cate);
        $brand = Brand::all();
        // dd($brand);
        return view("admin.goods.edit",['brand'=>$brand,'cate'=>$cate,'goods'=>$goods]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGoodsPost $request, $id)
    {
        $post = $request->except("_token");
        // 处理单个图片
        if($request->hasFile('goods_img')){
            $post['goods_img'] = upload('goods_img');
        }
         // 修改入库
        $res = Goods::where('goods_id',$id)->update($post);
        if($res!==false){
            return redirect('/goods');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $goods_id = request()->id;
        // echo $goods_id;
      // $res =  Goods::destroy($goods_id);
        $res = Goods::where('goods_id',$goods_id)->delete();
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'删除成功！']);die;
        }
    }


}
