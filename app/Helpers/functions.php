<?php 


// 无限极分类
     function createTree($data,$pid=0,$level=1){
        if(!$data){
            return;
        }
        static $info = [];
        foreach($data as $k=>$v){
            if($v->p_id==$pid){
                $v->level=$level;
                $info[] = $v;
                createTree($data,$v->cate_id,$level+1);
            }
        }
        return $info;
    }

    // 文件上传
     function upload($filename){
        if(request()->file($filename)->isValid()){
            // 接受上传文件
            $file = request()->$filename;
            // 实现上传
            $path = $file->store("uploads");
            return $path;
        }
        exit("上传文件失败！");
    }

    // 多文件上传
     function moreupload($filename){
    	$file = request()->$filename;
    	if(!is_array($file)){
    		return;
    	}
    	foreach($file as $k=>$v){
    		// 实现上传
    		$path[$k] = $v->store('uploads');
    	}
    	return $path;
    	exit("上传文件失败！");
    }



 ?>