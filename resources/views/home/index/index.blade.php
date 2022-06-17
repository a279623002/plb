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
        @foreach ($list as $item)
        <li class="box" onclick="window.location.href='{{url('log/'.$item->log_id)}}'">
            <div class="li-top">
                <h2>{{$item->title}}</h2>
                <h3>{{date('Y-m-d H:i:s', $item->addtime)}}</h3>
            </div>
            <div class="li-content">
                <div id="editormd-view{{$item->log_id}}">
                    <textarea id="append-test">
                            {{$item->content}}
                    </textarea>
                </div>

                <script type="text/javascript">
                    $(function () {
                        var testEditormdView;

                        testEditormdView = editormd.markdownToHTML("editormd-view{{$item->log_id}}", {
                            htmlDecode: "style,script,iframe",  // you can filter tags decode
                            emoji: true,
                            taskList: true,
                            tex: true,  // 默认不解析
                            flowChart: true,  // 默认不解析
                            sequenceDiagram: true,  // 默认不解析
                        });
                    });
                </script>
            </div>
            <div class="li-bottom">
                <div class="li-bottom-col">
                    <i></i>{{$item->tag_name}}
                </div>
                <div class="li-bottom-col">
                    <i></i>{{$item->click}}
                </div>
            </div>
        </li>
        @endforeach
        <div class="page">
            {{$list->links()}}
        </div>
    </ul>
    @include('home.common.footer')
</main>

</body>

</html>