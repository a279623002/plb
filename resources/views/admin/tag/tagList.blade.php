@include('admin.common.header')
<style>
    .x-admin-sm .layui-icon {
        font-size: 26px;
    }
</style>

<body>
    <meta name="csrf-token" content="{{csrf_token()}}">

    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body ">
                        <form class="layui-form layui-col-space5">

                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="name" placeholder="搜索标题" value="{{$name}}" autocomplete="off"
                                    class="layui-input">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <button class="layui-btn" lay-submit="" lay-filter="sreach"><i
                                        class="layui-icon"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="layui-card-header">
                        <button class="layui-btn" onclick="xadmin.open('添加标签','{{url('Admin/tagEdit')}}',500,200)"><i
                                class="layui-icon"></i>添加标签</button>
                    </div>
                    <div class="layui-card-body ">
                        <table class="layui-table layui-form">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>添加时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                <tr>
                                    <td>{{$item->tag_id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{date('Y-m-d H:i:s', $item->addtime)}}</td>
                                    <td class="td-status">
                                        <span class="layui-btn layui-btn-normal layui-btn-mini">{{$item->status}}</span>
                                    </td>
                                    <td class="td-manage">
                                        <a onclick="xadmin.open('修改标签','{{url('Admin/tagEdit/'.$item->tag_id)}}',500,200)"
                                            name="修改标签" href="javascript:;">
                                            <i class="layui-icon">&#xe631;</i>
                                        </a>
                                        <a name="删除" onclick="tag_del(this,'{{$item->tag_id}}')" href="javascript:;">
                                            <i class="layui-icon"></i>
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
    <script>
        layui.use(['laydate', 'form']);

        /*标签-删除*/
        function tag_del(obj, id) {
            layer.confirm('确认要删除吗？', function (index) {
                //发异步删除数据
                $.ajax({
                    url: '{{url('Admin/tagDel')}}',
                    type: 'post',
                    dataType: 'json',
                    data: { tag_id: id },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (result) {
                        if (result.state) {
                            $(obj).parents("tr").remove();
                            layer.msg(result.msg, { icon: 1, time: 1000 });
                        } else {
                            layer.msg(result.msg);
                        }
                    }
                });

            });
        }
    </script>
</body>

</html>