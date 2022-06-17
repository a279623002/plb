<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Storage;

class TagController extends BaseController
{

    // 标签列表
    public function tagList (Request $request)
    {
        $name = $request->input('name');
        
        $list = DB::table('tag')->where('name', 'like', '%'.$name.'%')->orderBy('addtime', 'desc')->paginate(15);
        return view('admin.tag.tagList', ['list'=>$list, 'name'=>$name]);
    }

    // 删除标签
    public function tagDel (Request $request)
    {
        $tag_id = $request->input('tag_id');
        if (DB::table('tag')->where('tag_id', $tag_id)->delete()) {
            $result = array('state'=>true, 'msg'=>'删除成功');
        } else {
            $result = array('state'=>false, 'msg'=>'删除失败');
        }
        exit(json_encode($result));
    }

    // 添加、编辑标签
    public function tagEdit (Request $request)
    {
        $row['name'] = !empty($request->input('name')) ? $request->input('name') : '';
        $row = array_filter($row);
        if (!empty($row)) {
            $tag_id = !empty($request->input('tag_id')) ? $request->input('tag_id') : '';
            if (!empty($tag_id)) {
                if (DB::table('tag')->where('tag_id', $tag_id)->update($row)) {
                    $result = array('state'=>true, 'msg'=>'操作成功');
                } else {
                    $result = array('state'=>false, 'msg'=>'操作失败');
                }
            } else {
                $row['addtime'] = time();
                if (DB::table('tag')->insert($row)) {
                    $result = array('state'=>true, 'msg'=>'操作成功');
                } else {
                    $result = array('state'=>false, 'msg'=>'操作失败');
                }
            }
            exit(json_encode($result));
        } else {
            $tag_id = $request->route('tag_id');
            if (!empty($tag_id)) {
                $detail = DB::table('tag')->where('tag_id', $tag_id)->first();
                return view('admin.tag.tagEdit', ['detail'=>$detail]);
            } else {
                return view('admin.tag.tagEdit'); 
            }
        }
    }

}
