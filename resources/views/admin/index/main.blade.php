@include('admin.common.header')
    <body>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <blockquote class="layui-elem-quote">欢迎管理员：
                                <span class="x-red">{{$admin->name}}</span>！当前时间:{{date('Y-m-d H:i:s', time())}}
                            </blockquote>
                        </div>
                    </div>
                </div>
                
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">系统信息</div>
                        <div class="layui-card-body ">
                            <table class="layui-table">
                                <tbody>
                                    <tr>
                                        <th>系统版本</th>
                                        <td>1.0.0</td></tr>
                                    <tr>
                                        <th>服务器地址</th>
                                        <td>{{$_SERVER['HTTP_HOST']}}</td></tr>
                                    <tr>
                                        <th>操作系统</th>
                                        <td>{{PHP_OS}}</td></tr>
                                    <tr>
                                        <th>运行环境</th>
                                        <td>{{$_SERVER['SERVER_SOFTWARE']}}</td></tr>
                                    <tr>
                                        <th>系统框架</th>
                                        <td>ThinkPHP 3.2.3</td></tr>
                                    <tr>
                                        <th>PHP版本</th>
                                        <td>{{PHP_VERSION}}</td></tr>
                                    <tr>
                                        <th>PHP运行方式</th>
                                        <td>{{php_sapi_name()}}</td></tr>
                                    <tr>
                                        <th>上传附件限制</th>
                                        <td>{{ini_get('upload_max_filesize')}}</td></tr>
                                    <tr>
                                        <th>执行时间限制</th>
                                        <td>{{ini_get('max_execution_time')}}秒</td></tr>
                                    <tr>
                                        <th>剩余空间</th>
                                        <td>
                                        </td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">开发团队</div>
                        <div class="layui-card-body ">
                            <table class="layui-table">
                                <tbody>
                                    <tr>
                                        <th>版权所有</th>
                                        <td>Zero
                                            <a href="http://siro.zerogod.cn/" target="_blank">访问</a></td>
                                    </tr>
                                    <tr>
                                        <th>开发者</th>
                                        <td>Zero(970979353@qq.com)</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <style id="welcome_style"></style>
            </div>
        </div>
        </div>
    </body>
</html>