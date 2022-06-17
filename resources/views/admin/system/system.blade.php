@include('admin.common.header')

<body>

    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <form method="post" class="layui-form" id="taskForm" enctype="multipart/form-data">
                        @csrf
                        <div class="layui-card-body" style="padding: 15px;">
                            <form class="layui-form" action="" lay-filter="component-form-group">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">logo:</label>
                                    <div class="layui-input-block">
                                        <input type="radio" name="logo" value="1" title="黑" @if ($detail->logo === 1)
                                        checked="" @endif>
                                        <div class="layui-unselect layui-form-radio"><i
                                                class="layui-anim layui-icon"></i>
                                            <div>黑</div>
                                        </div>
                                        <input type="radio" name="logo" value="2" title="白" @if ($detail->logo === 2)
                                        checked="" @endif>
                                        <div class="layui-unselect layui-form-radio"><i
                                                class="layui-anim layui-icon"></i>
                                            <div>白</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">主题:</label>
                                    <div class="layui-input-block">
                                        <input type="radio" name="theme" value="1" title="默认" @if ($detail->theme === 1)
                                        checked="" @endif>
                                        <div class="layui-unselect layui-form-radio"><i
                                                class="layui-anim layui-icon"></i>
                                            <div>默认</div>
                                        </div>
                                        <input type="radio" name="theme" value="2" title="简约" @if ($detail->theme === 2)
                                        checked="" @endif>
                                        <div class="layui-unselect layui-form-radio"><i
                                                class="layui-anim layui-icon"></i>
                                            <div>简约</div>
                                        </div>
                                        <input type="radio" name="theme" value="3" title="少年" @if ($detail->theme === 3)
                                        checked="" @endif>
                                        <div class="layui-unselect layui-form-radio layui-form-radioed"><i
                                                class="layui-anim layui-icon layui-anim-scaleSpring"></i>
                                            <div>少年</div>
                                        </div>
                                        <input type="radio" name="theme" value="4" title="少女" @if ($detail->theme === 4)
                                        checked="" @endif>
                                        <div class="layui-unselect layui-form-radio"><i
                                                class="layui-anim layui-icon"></i>
                                            <div>少女</div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="layui-form-item">
                                    <label class="layui-form-label">主题:</label>
                                    <div class="layui-input-block">
                                        <input type="radio" name="font" value="1" title="默认字体" @if ($detail->font === 1)
                                        checked="" @endif>
                                        <div class="layui-unselect layui-form-radio"><i
                                                class="layui-anim layui-icon"></i>
                                            <div>默认字体</div>
                                        </div>
                                        <input type="radio" name="font" value="2" title="园体" @if ($detail->font === 2)
                                        checked="" @endif>
                                        <div class="layui-unselect layui-form-radio"><i
                                                class="layui-anim layui-icon"></i>
                                            <div>园体</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">空间</label>
                                    <div class="layui-input-inline">
                                        <input type="text" id="name" name="name" value="{{$detail->name}}" required=""
                                            lay-verify="name" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">简介</label>
                                    <div class="layui-input-inline">
                                        <input type="text" id="tip" name="tip" value="{{$detail->tip}}" required=""
                                            lay-verify="tip" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">git</label>
                                    <div class="layui-input-inline">
                                        <input type="text" id="git" name="git" value="{{$detail->git}}" required=""
                                            lay-verify="url" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">sina</label>
                                    <div class="layui-input-inline">
                                        <input type="text" id="sina" name="sina" value="{{$detail->sina}}" required=""
                                            lay-verify="url" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">qq-email</label>
                                    <div class="layui-input-inline">
                                        <input type="text" id="qq" name="qq" value="{{$detail->qq}}" required=""
                                            lay-verify="qq" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">版权</label>
                                    <div class="layui-input-inline">
                                        <input type="text" id="copyright" name="copyright" value="{{$detail->copyright}}" required=""
                                            lay-verify="copyright" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">头像</label>
                                    <div class="layui-input-inline">
                                        <input type="file" name="headimg" accept="image/*" />
                                    </div>
                                    @if (!empty($detail->headimg))
                                        <div class="layui-input-inline">
                                            <div class="layui-upload-list" style="margin:0;">
                                                <img src="{{asset('storage/'.$detail->headimg)}}"
                                                    class="layui-upload-img" style="width: 150px;">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">背景</label>
                                    <div class="layui-input-inline">
                                        <input type="file" name="banner" accept="image/*" />
                                    </div>
                                    @if (!empty($detail->banner))
                                        <div class="layui-input-inline">
                                            <div class="layui-upload-list" style="margin:0;">
                                                <img src="{{asset('storage/'.$detail->banner)}}"
                                                    class="layui-upload-img" style="width: 150px;">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="layui-form-item">
                                    <label for="" class="layui-form-label"></label>
                                    <button class="layui-btn" lay-filter="save" lay-submit="">保存</button>
                                </div>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script>
        $(function () {
            layui.use('form', function () {
                var form = layui.form;
                form.verify({
                    name: [/(.+){1,12}$/, '空间名1到20位'],
                    tip: [/(.+)+$/, '简介至少1位'],
                    copyright: [/(.+)+$/, '版权至少1位'],
                    qq: [/[\w!#$%&'*+/=?^_`{|}~-]+(?:\.[\w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?/, '请输入正确的qq邮箱'],
                });
                form.on('submit(save)', function (data) {
                    var formData = new FormData(document.getElementById("taskForm"));
                    $.ajax({
                        url: '{{url('Admin/system')}}',
                        type: 'post',
                        dataType: 'json',
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
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