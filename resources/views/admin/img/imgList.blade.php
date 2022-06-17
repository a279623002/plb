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
                    <div class="layui-card-header">
                        <button class="layui-btn" onclick="xadmin.open('添加图片','{{url('Admin/imgAdd')}}',600,400)"><i
                                class="layui-icon"></i>添加图片</button>
                    </div>
                    <div class="layui-card-body ">
                        <table class="layui-table layui-form">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>图片</th>
                                    <th>地址</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                <tr>
                                    <td>{{$item->img_id}}</td>
                                    <td><a href="{{asset('storage/'.$item->name)}}" target="_blank"><img src="{{asset('storage/'.$item->name)}}" style="width: 50px;"></a></td>
                                    <td><span>{{asset('storage/'.$item->name)}}</span></td>
                                    <td>{{date('Y-m-d H:i:s', $item->addtime)}}</td>
                                    <td class="td-manage">
                                        <a title="删除" onclick="img_del(this,'{{$item->img_id}}')" href="javascript:;">
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

        /*图片-删除*/
        function img_del(obj, id) {
            layer.confirm('确认要删除吗？', function (index) {
                //发异步删除数据
                $.ajax({
                    url: '{{url('Admin/imgDel')}}',
                    type: 'post',
                    dataType: 'json',
                    data: { img_id: id },
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