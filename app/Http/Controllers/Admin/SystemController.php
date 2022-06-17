<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Storage;

class SystemController extends BaseController
{
    // 系统设置
    public function system (Request $request)
    {
        $row['headimg'] = !empty($request->file('headimg')) ? Storage::disk('public')->putFile('system', $request->file('headimg')) : '';
        $row['banner'] = !empty($request->file('banner')) ? Storage::disk('public')->putFile('system', $request->file('banner')) : '';
        $row['theme'] = !empty($request->input('theme')) ? $request->input('theme') : '';
        $row['font'] = !empty($request->input('font')) ? $request->input('font') : '';
        $row['name'] = !empty($request->input('name')) ? $request->input('name') : '';
        $row['tip'] = !empty($request->input('tip')) ? $request->input('tip') : '';
        $row['git'] = !empty($request->input('git')) ? $request->input('git') : '';
        $row['sina'] = !empty($request->input('sina')) ? $request->input('sina') : '';
        $row['qq'] = !empty($request->input('qq')) ? $request->input('qq') : '';
        $row['copyright'] = !empty($request->input('copyright')) ? $request->input('copyright') : '';
        $row['logo'] = !empty($request->input('logo')) ? $request->input('logo') : '';
        $row = array_filter($row);
        if (!empty($row)) {
            $system_id = 1;
            if (!empty($row['banner'])) $banner = DB::table('system')->where('system_id', $system_id)->value('banner');
            if (!empty($row['headimg'])) $headimg = DB::table('system')->where('system_id', $system_id)->value('headimg');
            if (DB::table('system')->where('system_id', $system_id)->update($row)) {
                if (!empty($banner)) @unlink('./storage/'.$banner);
                if (!empty($headimg)) @unlink('./storage/'.$headimg);
                $result = array('state'=>true, 'msg'=>'操作成功');
            } else {
                $result = array('state'=>false, 'msg'=>'操作失败');
            }
            exit(json_encode($result));
        } else {
            $detail = DB::table('system')->first();
            return view('admin.system.system', ['detail'=>$detail]);
        }
        
    }

}
