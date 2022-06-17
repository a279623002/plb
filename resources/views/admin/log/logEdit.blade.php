@include('admin.common.header')

<body>
    <link rel="stylesheet" href="{{URL::asset('editor/editormd.css')}}" />

    <div class="layui-fluid">
        <div class="layui-row">
            <form method="post" class="layui-form">
                @csrf
                <input type="hidden" name="log_id" value="{{isset($detail->log_id) ? $detail->log_id : ''}}">
                <div class="layui-form-item">
                    <label class="layui-form-label">标签</label>
                    <div class="layui-input-block">
                        @foreach ($tag as $item)
                            <input type="radio" name="tag_id" value="{{$item->tag_id}}" title="{{$item->name}}" @if (empty($detail->tag_id) || $item->tag_id == $detail->tag_id) checked @endif>
                            <div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i>
                                <div>{{$item->name}}</div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_title" class="layui-form-label">标题</label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_title" name="title" required=""
                            value="{{isset($detail->title) ? $detail->title : ''}}" class="layui-input"></div>
                </div>
                <div id="test-editormd">
                    <textarea style="display:none;"
                        name="content">{{isset($detail->content) ? $detail->content : ''}}</textarea>
                </div>
                <script src="{{URL::asset('editor/editormd.min.js')}}"></script>
                <script type="text/javascript">
                    var testEditor;

                    $(function () {
                        testEditor = editormd("test-editormd", {
                            width: "90%",
                            height: 640,
                            syncScrolling: "single",
                            path: "{{URL::asset('editor')}}/"
                        });

                        /*
                        // or
                        testEditor = editormd({
                            id      : "test-editormd",
                            width   : "90%",
                            height  : 640,
                            path    : "../lib/"
                        });
                        */
                    });
                </script>

                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label"></label>
                    <button class="layui-btn" lay-filter="save" lay-submit="">保存</button></div>
            </form>
        </div>
    </div>
    <script>
        $(function () {
            layui.use('form', function () {
                var form = layui.form;
                form.verify({
                });
                form.on('submit(save)', function (data) {
                    $.ajax({
                        url: '{{url('Admin/logEdit')}}',
                        type: 'post',
                        dataType: 'json',
                        data: data.field,
                        success: function (result) {
                            if (result.state) {
                                layer.msg(result.msg, {
                                    icon: 6,
                                    time: 2000
                                }, function () {
                                    xadmin.close();
                                    xadmin.father_reload();
                                });
                            } else {
                                layer.msg(result.msg);
                            }
                        }
	  				});
                return false;
            });
        });
        });
    </script>
</body>

</html>