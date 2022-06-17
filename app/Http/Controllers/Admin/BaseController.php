<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use DB;

class BaseController extends Controller
{
    public function __construct ()
    {
        $admin = Cache::get('admin');
        if (!empty($admin)) {
			view()->share('admin', $admin);
		}else{
            $nologin = array(
				'login'
            );
			if (!in_array($this->getCurrentAction()['method'], $nologin)) {
				header("location:" . url('Admin/login'));
				exit;
			}
		}
    }

    /**
     * 获取当前控制器与方法
     *
     * @return array
     */
    public function getCurrentAction ()
    {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);

        return ['controller' => $class, 'method' => $method];
    }
}
