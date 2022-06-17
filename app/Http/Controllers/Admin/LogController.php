<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LogController extends BaseController
{

    // 日志列表
    public function logList (Request $request)
    {
        $title = $request->input('title');
        $type = $request->input('type');
        $tag_id = $request->input('tag_id');
        if (!empty($tag_id)) {
            $tag = DB::table('tag')->where('tag_id', $tag_id)->first();
            view()->share('tag', $tag);
        }
        $list = DB::table('log')->when($title, function($query) use ($title) {
            return $query->where('title', 'like', '%'.$title.'%');
        })->when($tag_id, function($query) use ($tag_id) {
            return $query->where('tag_id', $tag_id);
        })->orderBy('addtime', 'desc')->paginate(15);
        if (!empty($type) && $type ==1) {
            foreach ($list as $key => $value) {
                $value->is_remark = DB::table('remark')->where('log_id', $value->log_id)->count();
                if ($value->is_remark == 0) {
                    unset($list[$key]);
                }
            }
        }
        foreach ($list as $key => $value) {
            $value->tag_name = DB::table('tag')->where('tag_id', $value->tag_id)->value('name');
            $value->remark = DB::table('remark')->where('log_id', $value->log_id)->where('status', 1)->count();
        }
        $tagList = DB::table('tag')->orderBy('addtime', 'desc')->get();
        return view('admin.log.logList', ['list'=>$list, 'title'=>$title, 'type'=>$type, 'tagList'=>$tagList]);
    }

    // 删除日志
    public function logDel (Request $request)
    {
        $log_id = $request->input('log_id');
        if (DB::table('log')->where('log_id', $log_id)->delete()) {
            DB::table('remark')->where('log_id', $log_id)->delete();
            $result = array('state'=>true, 'msg'=>'删除成功');
        } else {
            $result = array('state'=>false, 'msg'=>'删除失败');
        }
        exit(json_encode($result));
    }

    // 添加、编辑日志
    public function logEdit (Request $request)
    {
        $data = $request->all();
        if (!empty($data)) {
            $row = array(
                'title'     => $data['title'],
                'content'   => $data['content'],
                'tag_id'    => $data['tag_id'],
            );
            if (!empty($data['log_id'])) {
                if (DB::table('log')->where('log_id', $data['log_id'])->update($row)) {
                    $result = array('state'=>true, 'msg'=>'操作成功');
                } else {
                    $result = array('state'=>false, 'msg'=>'操作失败');
                }
            } else {
                $row['addtime'] = time();
                if (DB::table('log')->insert($row)) {
                    $result = array('state'=>true, 'msg'=>'操作成功');
                } else {
                    $result = array('state'=>false, 'msg'=>'操作失败');
                }
            }
            exit(json_encode($result));
        } else {
            // 标签列表
            $tag = DB::table('tag')->orderBy('addtime', 'desc')->get();
            view()->share('tag', $tag);
            $log_id = $request->route('log_id');
            if (!empty($log_id)) {
                $detail = DB::table('log')->where('log_id', $log_id)->first();
                return view('admin.log.logEdit', ['detail'=>$detail]);
            } else {
                return view('admin.log.logEdit'); 
            }
        }
    }

    
    // 评论列表
    public function remarkList (Request $request)
    {
        $log_id = $request->route('log_id');
        $list = DB::table('remark')->where('log_id', $log_id)->orderBy('addtime', 'desc')->paginate(15);
        DB::table('remark')->where('log_id', $log_id)->update(array('status'=>2));
        return view('admin.log.remarkList', ['list'=>$list]);
    }
    
    // 删除评论
    public function remarkDel (Request $request)
    {
        $remark_id = $request->input('remark_id');
        if (DB::table('remark')->where('remark_id', $remark_id)->delete()) {
            $result = array('state'=>true, 'msg'=>'删除成功');
        } else {
            $result = array('state'=>false, 'msg'=>'删除失败');
        }
        exit(json_encode($result));
    }
}
