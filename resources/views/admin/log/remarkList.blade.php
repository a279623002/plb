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
                        <table class="layui-table layui-form">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>姓名</th>
                                    <th>邮箱</th>
                                    <th>内容</th>
                                    <th>添加时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                <tr>
                                    <td>{{$item->remark_id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td class="taskContent">{{$item->content}}</td>
                                    <td>{{date('Y-m-d H:i:s', $item->addtime)}}</td>
                                    <td class="td-status">
                                        @if ($item->status == 1)
                                            <span class="layui-btn layui-btn layui-btn-danger layui-btn-mini">未读</span>
                                        @else 
                                            <span class="layui-btn layui-btn-normal layui-btn-mini">已读</span>
                                        @endif
                                    </td>
                                    <td class="td-manage">
                                        <a title="删除" onclick="remark_del(this,'{{$item->remark_id}}')"
                                            href="javascript:;">
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

        /*评论-删除*/
        function remark_del(obj, id) {
            layer.confirm('确认要删除吗？', function (index) {
                //发异步删除数据
                $.ajax({
                    url: '{{url('Admin/remarkDel')}}',
                    type: 'post',
                    dataType: 'json',
                    data: { remark_id: id },
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

        //查看结果

        function replace_em(str) {

            str = str.replace(/\</g, '&lt;');

            str = str.replace(/\>/g, '&gt;');

            str = str.replace(/\n/g, '<br/>');

            str = str.replace(/\[em_([0-9]*)\]/g, '<img src="/Home/js/images/$1.gif" border="0" />');

            return str;

        }

        $(function() {
            $('.taskContent').each(function() {
                $(this).html(replace_em($(this).html()));
            })
        })
    </script>
</body>

</html>