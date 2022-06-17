<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Storage;

class ImgController extends BaseController
{

    // 图片列表
    public function imgList (Request $request)
    {
        
        $list = DB::table('img')->orderBy('addtime', 'desc')->paginate(15);
        return view('admin.img.imgList', ['list'=>$list]);
    }

    // 删除图片
    public function imgDel (Request $request)
    {
        $img_id = $request->input('img_id');
        $name = DB::table('img')->where('img_id', $img_id)->value('name');
        if (DB::table('img')->where('img_id', $img_id)->delete()) {
            @unlink('./storage/'.$name);
            $result = array('state'=>true, 'msg'=>'删除成功');
        } else {
            $result = array('state'=>false, 'msg'=>'删除失败');
        }
        exit(json_encode($result));
    }

    // 添加图片
    public function imgAdd (Request $request)
    {
        $row['name'] = !empty($request->file('name')) ? Storage::disk('public')->putFile('img', $request->file('name')) : '';
        $row = array_filter($row);
        if (!empty($row)) {
            $row['addtime'] = time();
            if (DB::table('img')->insert($row)) {
                $result = array('state'=>true, 'msg'=>'操作成功');
            } else {
                $result = array('state'=>false, 'msg'=>'操作失败');
            }
            exit(json_encode($result));
        } else {
            return view('admin.img.imgAdd'); 
        }
    }

}
