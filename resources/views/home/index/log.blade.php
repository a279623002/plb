@include('home.common.header')
<main>
    <link rel="stylesheet" href="{{URL::asset('editor/editormd.preview.css')}}">
    <script src="{{URL::asset('Home/js/font.js')}}"></script>
    <script src="{{URL::asset('Home/js/jquery.js')}}"></script>
    <script src="{{URL::asset('editor/marked.min.js')}}"></script>
    <script src="{{URL::asset('editor/prettify.min.js')}}"></script>
    <script src="{{URL::asset('editor/raphael.min.js')}}"></script>
    <script src="{{URL::asset('editor/underscore.min.js')}}"></script>
    <script src="{{URL::asset('editor/sequence-diagram.min.js')}}"></script>
    <script src="{{URL::asset('editor/flowchart.min.js')}}"></script>
    <script src="{{URL::asset('editor/jquery.flowchart.min.js')}}"></script>
    <script src="{{URL::asset('editor/editormd.min.js')}}"></script>
    <ul>
        <li class="box">
            <div class="li-top">
                <h2>{{$detail->title}}</h2>
                <h3>{{date('Y-m-d H:i:s', $detail->addtime)}}</h3>
            </div>
            <div class="li-bottom">
                <div class="li-bottom-col">
                    <i></i>{{$detail->tag_name}}
                </div>
                <div class="li-bottom-col">
                    <i></i>{{$detail->click}}
                </div>
            </div>
        </li>
    </ul>
    <div class="content" id="editormd-view">
        <textarea id="append-test">
            {{$detail->content}}
        </textarea>
    </div>

    <script type="text/javascript">
        $(function () {
            var testEditormdView;

            testEditormdView = editormd.markdownToHTML("editormd-view", {
                htmlDecode: "style,script,iframe",  // you can filter tags decode
                emoji: true,
                taskList: true,
                tex: true,  // 默认不解析
                flowChart: true,  // 默认不解析
                sequenceDiagram: true,  // 默认不解析
            });
        });
    </script>
  <!--
    <div class="footer">
        <h2>发表评论</h2>
        <form action="" id="remark">
            @csrf
            <input type="hidden" name="log_id" value="{{$detail->log_id}}">
            <div class="row">
                <div class="col">
                    <label for="name">姓名</label>
                    <input type="text" name="name" id="name" placeholder="" />
                </div>
                <div class="col">
                    <label for="email">邮箱</label>
                    <input type="text" name="email" id="email" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="row">
                <textarea class="input" id="saytext" name="content"></textarea>
                <p>
                    <button id="toRemark">评论</button>
                    <span class="emotion">表情</span>
                </p>
                <div id="show">Please comment if you have any question or guide<img src="{{URL::asset('Home/js/images/1.gif')}}" border="0"></div>
            </div>
        </form>

    </div>
-->
    @include('home.common.footer')
</main>
<script src="{{URL::asset('Home/js/font.js')}}"></script>
<!--
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
-->
<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{URL::asset('Home/js/jquery.qqFace.js')}}"></script>
<script type="text/javascript">
/*
    $(function () {

        $('.emotion').qqFace({

            id: 'facebox',

            assign: 'saytext',

            path: '/Home/js/images/'	//表情存放的路径

        });

        $('#saytext').on('change keydown keyup input', function (event) {

            update_show();

        });


    });
    // 评论显示同步

    function update_show() {
        var str = $("#saytext").val();

        $("#show").html(replace_em(str));
    }

    //查看结果

    function replace_em(str) {

        str = str.replace(/\</g, '&lt;');

        str = str.replace(/\>/g, '&gt;');

        str = str.replace(/\n/g, '<br/>');

        str = str.replace(/\[em_([0-9]*)\]/g, '<img src="/Home/js/images/$1.gif" border="0" />');

        return str;

    }

*/
</script>
<script>

    $(function () {
        $('#toRemark').on('click', function () {
            var check = true;
            var name = $('#name'), email = $('#email'), saytext = $('#saytext');
            if (name.val() == '') {
                check = false;
                name.css('border-color', 'red');
                name.attr('placeholder', '请填写姓名');
            }
            if (email.val() == '') {
                check = false;
                email.css('border-color', 'red');
                email.attr('placeholder', '请填写邮箱');
            }
            var reg = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
            if (!reg.test(email.val())) {
                check = false;
                email.css('border-color', 'red');
                email.val('');
                email.attr('placeholder', '邮箱格式错误');
            }
            if (saytext.val() == '') {
                check = false;
                saytext.css('border-color', 'red');
                saytext.attr('placeholder', '请输入评论');
            }
            if (check) {
                $.ajax({
                    url: '{{url('remark')}}',
                    type: 'post',
                    dataType: 'json',
                    data: $('#remark').serialize(),
                    success: function (result) {
                        alert(result.msg);
                        if (result.state) {
                            name.val('');
                            email.val('');
                            saytext.val('');
                            email.attr('placeholder', '');
                        }
                    }
                });
            }
            return false;
        })
    })
</script>
</body>

</html>