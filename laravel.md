# laravel 实战 -- 个人门户

## 前台页面

1 首页 (index)

> articleList、userInfo

2 日志 (article)

> articleList articleAdd articleDel

3 评论 (remark)

> remarkList remarkAdd

## 后台页面

1 管理员管理 (admin)

> login adminEdit


2 文章管理 (article)

> articleList articleAdd articleEdit articleDel

>> 评论列表

>> remarkList remarkDel

## 初始化

1 环境要求

* PHP >= 7.1.3

* OpenSSL PHP 拓展

* PDO PHP 拓展

* Mbstring PHP 拓展

* Tokenizer PHP 拓展

* XML PHP 拓展

* Ctype PHP 拓展

* JSON PHP 拓展

* BCMath PHP 拓展

2 安装composer

> https://docs.phpcomposer.com/00-intro.html

> php版本需一致

3 安装 Laravel

> composer create-project --prefer-dist laravel/laravel laravel

4 配置文件

> 数据库配置（.env）

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
```

6 配置路由

> 前台

```
Route::namespace('Home')->group(function () {
    Route::get('/', 'IndexController@index');
});
```

7 创建控制器模块

> php artisan make:controll Home/IndexControll

```
<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    // 首页
    public function index () {
        return view('home.index.index');
    }
}
```

8 模型创建

> php artisan make:model Home/User

> 控制器引入 (use App\Home\User;)


9 创建视图

> /resources/views/home/index/index.blade.php

10 引入公共头部

> @include('home.common.header')

11 引入文件路径

> {{URL::asset('Home/js/font.js')}}

12 路由跳转

> {{url('article')}}

13 变量注入视图

> 与tp的assign相同的方式

```
view()->share('admin', $admin);
```

14 分页

> 控制器

```
$list = DB::table('admin')->paginate(1);
```

> 视图

```
{{$list->links()}}
```

15 获取路由参数5种方法

> 路由参数定义

```
/**
* 定义路由参数名称分别为： param1，param2
*/
Route::get('/{param1}/{param2}', 'TestController@index');
```

> 控制器

```
/**
* 路由参数获取方法
*
* @param Illuminate\Http\Request $request    依赖注入 Request 实例，放在参数中什么位置都可以自动加载
* @param mixed $arg2    要获取的路由参数
* @param mixed $arg1    要获取的路由参数
*/

public function index(Request $request, $arg2, $arg1)
{

    /**
    * 方法一：按照 URL 中路由参数先后顺序来获取
    * 注意：此种方式有个小坑，获取的值只与顺序有关，与名称无关
    */
    echo $arg2;    //结果为 1 ，因为 $arg2 在第一位，获取的是第一个路由参数 param1 的值
    echo $arg1;    //结果为 2 ，因为 $arg1 在第二位，获取的是第二个路由参数 param2 的值

    /**
    * 方法二：按照路由参数名称来获取
    * 注意：此处名称是 Route 中定义的参数名，非上面方法中的参数名 
    */
    $request->route('param1');      //结果为 1 ，获取的是第一个路由参数
    $request->route('param2');      //结果为 2 ，获取的是第二个路由参数

    /**
    * 方法三：使用 request() 辅助函数来获取，效果同方法二
    */
    request()->route('param1');     //结果为 1 ，如果不带路由参数名则返回当前的Route对象
    request()->route('param2');     //结果为 2 ，如果不带路由参数名则返回当前的Route对象

    /**
    * 方法四：使用 Route Facade
    */
    \Route::input('param1');     //结果为 1 ，该方法必须带路由参数名
    \Route::input('param2');     //结果为 2 ，该方法必须带路由参数名

    /**
    * 方法五：使用 Illuminate\Http\Request 实例动态属性
    */
    $request->param1;   //结果为 1 ，Laravel 5.4+ 可用
    $request->param2;   //结果为 2 ，Laravel 5.4+ 可用

    // 或者
    request()->param1;   //结果为 1 ，Laravel 5.4+ 可用
    request()->param2;   //结果为 2 ，Laravel 5.4+ 可用

    //或者
    request('param1');   //结果为 1 ，Laravel 5.4+ 可用
    request('param2');   //结果为 2 ，Laravel 5.4+ 可用

    /**
    * 注意：Laravel 在处理动态属性的优先级是，先从请求的数据（POST/GET）中查找，没有的话再到路由参数中找。
    * 例如：URL ： http://test.dev/1/2?param1=a&param2=b
    * $request->param1; request()->param1; request('param1');    //结果为 a
    * $request->param2; request()->param2; request('param2');    //结果为 b
    */
}
```

16 laravel 登录注册密码加密与解密

> 加密

```
bcrypt($data['password'])
// 等价于 Hash::make($data['password'])
```

> 解密

```
Hash::check($admin->password, $data['password'])
```

