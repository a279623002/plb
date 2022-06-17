<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use DB;
use Hash;

class IndexController extends BaseController
{

    // 后台首页
    public function main ()
    {
        
        return view('admin.index.main');
    }

    // 后台基本框架
    public function index ()
    {
        
        return view('admin.index.index');
    }

    // 后台登录
    public function login (Request $request)
    {
        $data = $request->all();
        if (!empty($data)) {
            $admin = DB::table('admin')->where('name', $data['name'])->first();
            if (empty($admin)) exit(json_encode(array('state'=>false, 'msg'=>'管理员账号不存在')));
            if ($data['password'] != decrypt($admin->password)) exit(json_encode(array('state'=>false, 'msg'=>'密码错误')));
            $row = array(
                'login_time'    => time(),
                'login_ip'      => $_SERVER['REMOTE_ADDR'],
            );
            
            if (DB::table('admin')->where('admin_id', $admin->admin_id)->update($row)) {
                Cache::put('admin', $admin, 3600);
                $result = array('state'=>true, 'msg'=>'登录成功');
            } else {
                $result = array('state'=>false, 'msg'=>'登录失败');
            }
            exit(json_encode($result));
        }
        return view('admin.index.login');
    }

    /**
     * 退出登录
     */
    public function logout ()
    {
    	Cache::forget('admin');
    	header("location:" . url('Admin/login'));
    	exit;
    }
}
