<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::namespace('Home')->group(function () {
    Route::get('/', 'IndexController@index');
    Route::get('/log/{log_id}', 'IndexController@log');
    Route::post('/remark', 'IndexController@remark');
});

Route::namespace('Admin')->group(function () {
    Route::get('/Admin/main', 'IndexController@main');
    Route::get('/Admin/index', 'IndexController@index');
    Route::any('/Admin/login', 'IndexController@login');
    Route::get('/Admin/logout', 'IndexController@logout');

    // 管理员
    Route::get('/Admin/adminList', 'AdminController@adminList');
    Route::any('/Admin/adminPassEdit/{admin_id?}', 'AdminController@adminPassEdit');

    // 标签
    Route::get('/Admin/tagList', 'TagController@tagList');
    Route::any('/Admin/tagEdit/{tag_id?}', 'TagController@tagEdit');
    Route::post('/Admin/tagDel', 'TagController@tagDel');

    // 日志
    Route::get('/Admin/logList', 'LogController@logList');
    Route::post('/Admin/logDel', 'LogController@logDel');
    Route::any('/Admin/logEdit/{log_id?}', 'LogController@logEdit');

    // 评论
    Route::get('/Admin/remarkList/{log_id?}', 'LogController@remarkList');
    Route::post('/Admin/remarkDel', 'LogController@remarkDel');

    
    // 图片
    Route::get('/Admin/imgList', 'ImgController@imgList');
    Route::post('/Admin/imgDel', 'ImgController@imgDel');
    Route::any('/Admin/imgAdd', 'ImgController@imgAdd');

    // 系统
    Route::any('/Admin/system', 'SystemController@system');
});