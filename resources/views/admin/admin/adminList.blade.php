@include('admin.common.header')
<style>
		.x-admin-sm .layui-icon {
    		font-size: 26px;
		}
	
	</style>
    <body>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <!-- <div class="layui-card-header">
                            <button class="layui-btn" onclick="xadmin.open('添加管理员','./adminAdd.html',600,400)"><i class="layui-icon"></i>添加管理员</button>
                        </div> -->
                        <div class="layui-card-body ">
                            <table class="layui-table layui-form">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>登录名</th>
                                  <th>登陆时间</th>
                                  <th>登陆IP</th>
                                  <th>状态</th>
                                  <th>操作</th>
                              </thead>
                              <tbody>
                              @foreach ($list as $item)
                                <tr>
                                  <td>{{$item->admin_id}}</td>
                                  <td>{{$item->name}}</td>
                                  <td>{{date('Y-m-d H:i:s', $item->login_time)}}</td>
                                  <td>{{$item->login_ip}}</td>
                                  <td class="td-status">
                                    <span class="layui-btn layui-btn-normal layui-btn-mini">{{$item->status}}</span></td>
                                  <td class="td-manage">
                                    <a onclick="xadmin.open('修改密码','{{url('Admin/adminPassEdit/'.$item->admin_id)}}',600,400)" title="修改密码" href="javascript:;">
                                        <i class="layui-icon">&#xe631;</i>
                                    </a>
                                  </td>
                                </tr>
                              @endforeach
                              </tbody>
                            </table>
                        </div>
                        <div class="layui-card-body ">
                            <div class="page">
                              {{$list->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </body>
</html>