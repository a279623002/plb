<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Illuminate\Contracts\Encryption\DecryptException;

class AdminController extends BaseController
{

    // 管理员列表
    public function adminList ()
    {
        $list = DB::table('admin')->paginate(1);
        return view('admin.admin.adminList', ['list'=>$list]);
    }

    // 管理员修改密码
    public function adminPassEdit (Request $request)
    {
        $admin_id = $request->route('admin_id');
        $detail = DB::table('admin')->where('admin_id', $admin_id)->first();
        if (!empty($detail)) {
            return view('admin.admin.adminPassEdit', ['detail'=>$detail]);
        }
        $data = $request->all();
        if (!empty($data)) {
            $admin = DB::table('admin')->where('admin_id', $data['admin_id'])->first();
            if ($data['password'] != decrypt($admin->password)) exit(json_encode(array('state'=>false, 'msg'=>'密码错误')));
            $row = array(
                'name'              => $data['name'],
                'password'          => encrypt($data['newpass'])
            );
            if (DB::table('admin')->where('admin_id', $data['admin_id'])->update($row)) {
                $result = array('state'=>true, 'msg'=>'修改成功');
            } else {
                $reuslt = array('state'=>false, 'msg'=>'修改失败');
            }
            exit(json_encode($result));
        }
    }

    

}
