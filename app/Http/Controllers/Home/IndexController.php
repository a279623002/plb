<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends BaseController
{
    // 首页
    public function index ()
    {
        $list = DB::table('log')->orderBy('addtime', 'desc')->paginate(7);
        foreach ($list as $key => $value) {
            $value->tag_name = DB::table('tag')->where('tag_id', $value->tag_id)->value('name');
        }
        return view('home.index.index', ['list'=>$list]);
    }

    // 日志
    public function log (Request $request)
    {
        $log_id = $request->route('log_id');
        
        DB::table('log')->where('log_id', $log_id)->increment('click'); //观看数加一
        $detail = DB::table('log')->where('log_id', $log_id)->first();
        $detail->tag_name = DB::table('tag')->where('tag_id', $detail->tag_id)->value('name');
        return view('home.index.log', ['detail'=>$detail]);
    }

    // 评论
    public function remark (Request $request)
    {
        $data = $request->all();
        $row = array(
            'log_id'                => $data['log_id'],
            'name'                  => $data['name'],
            'email'                 => $data['email'],
            'content'               => $data['content'],
            'addtime'               => time(),
        );
        if (DB::table('remark')->insert($row)) {
            $result = array('state'=>true, 'msg'=>'评论成功');
        } else {
            $result = array('state'=>false, 'msg'=>'评论失败');
        }
        exit(json_encode($result));
    }
}
