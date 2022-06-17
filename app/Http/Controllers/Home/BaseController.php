<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class BaseController extends Controller
{
    // 系统数据
    public function __construct ()
    {
        $system = DB::table('system')->first();
        view()->share('system', $system);
    }

}
