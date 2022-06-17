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
                            <div class="layui-inline">
                                <div class="layui-input-inline">
                                    <select name="tag_id" lay-search="">
                                        @if (!empty($tag))
                                            <option value="{{$tag->tag_id}}">{{$tag->name}}</option>
                                        @endif
                                        <option value="">所有分类</option>
                                        @foreach ($tagList as $item)
                                            <option value="{{$item->tag_id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="layui-inline">
                                <div class="layui-input-inline">
                                    <select name="type" lay-search="">
                                        @if (!empty($type))
                                            <option value="1">被评论</option>
                                        @endif
                                        <option value="">所有文章</option>
                                        <option value="1">被评论</option>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="title" placeholder="搜索标题" value="{{$title}}" autocomplete="off"
                                    class="layui-input">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <button class="layui-btn" lay-submit="" lay-filter="sreach"><i
                                        class="layui-icon"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="layui-card-header">
                        <button class="layui-btn" onclick="xadmin.open('添加日志','{{url('Admin/logEdit')}}',1200,800)"><i
                                class="layui-icon"></i>添加日志</button>
                    </div>
                    <div class="layui-card-body ">
                        <table class="layui-table layui-form">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>标签</th>
                                    <th>标题</th>
                                    <th>添加时间</th>
                                    <th>未读评论</th>
                                    <th>操作</th>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                <tr>
                                    <td>{{$item->log_id}}</td>
                                    <td>{{$item->tag_name}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{date('Y-m-d H:i:s', $item->addtime)}}</td>
                                    <td class="td-status">
                                        @if ($item->remark > 0)
                                        <span
                                            class="layui-btn layui-btn layui-btn-danger layui-btn-mini">{{$item->remark}}</span>
                                        @else
                                        <span class="layui-btn layui-btn-normal layui-btn-mini">{{$item->remark}}</span>
                                        @endif
                                    </td>
                                    <td class="td-manage">

                                        <a onclick="xadmin.open('评论列表','{{url('Admin/remarkList/'.$item->log_id)}}',1200,800)"
                                            title="评论列表" href="javascript:;">
                                            <i class="layui-icon">&#xe611;</i>
                                        </a>
                                        <a onclick="xadmin.open('修改日志','{{url('Admin/logEdit/'.$item->log_id)}}',1200,800)"
                                            title="修改日志" href="javascript:;">
                                            <i class="layui-icon">&#xe631;</i>
                                        </a>
                                        <a title="删除" onclick="log_del(this,'{{$item->log_id}}')" href="javascript:;">
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

        /*日志-删除*/
        function log_del(obj, id) {
            layer.confirm('确认要删除吗？', function (index) {
                //发异步删除数据
                $.ajax({
                    url: '{{url('Admin/logDel')}}',
                    type: 'post',
                    dataType: 'json',
                    data: { log_id: id },
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