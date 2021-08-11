<link rel="stylesheet"  href="/markdown/css/editormd.min.css" />

    <div class="layui-form" >
        <form action="/article/dell" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label" >文章标题</label>
                <div class="layui-input-block">
                    <input type="text" id="id" name="id" value="<?=$params['Article']['id']?>" hidden class="layui-input">
                    <input type="text" id="title" name="title" value="<?=$params['Article']['title']?>" placeholder="请输入文章标题" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">文章发布者</label>
                <div class="layui-input-block">

                    <input type="text" id="user_name" name="user_name" placeholder="请输入文章发布者" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" >文章内容</label>
                <div class="layui-input-block">
                    <div id="markdown">
                        <textarea style="display: none;" name="markdown-doc" id="markdown-doc"><?=$params['Article']['content']?></textarea>
                        <textarea style="display: none;" id="markdown-html-code" name="markdown-html-code" ></textarea>
                    </div>
                </div>
            </div>
            <div class="layui-input-block">
                <div class="layui-inline">
                    <button type="submit" id="submit" class="layui-btn" >发布文章</button>
                </div>
                <div class="layui-inline">
                    <a type="button" href="/article/index" class="layui-btn" >返回</a>
                </div>
            </div>
        </form>
    </div>

    <script src="/markdown/editormd.min.js" ></script>

    <script>
    $(function() {

        var editor = editormd("markdown", {
            width  : "100%",
            height : "600px",
            placeholder : "请输入要发布的内容...",
            htmlDecode : true,
            htmlDecode : "style,script,iframe",
            path   : "/markdown/lib/",
            theme :"dark",
            previewTheme : "dark",
            editorTheme:"pastel-on-dark",
            codeFold : true,
        });
    });

</script>
