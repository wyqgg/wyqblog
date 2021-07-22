<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet"  href="/markdown/css/editormd.min.css" />
</head>
<body>


    <div style="margin-bottom: 5px">
        <span class="layui-breadcrumb">
              <a href="">首页</a>
              <a><cite>文章管理</cite></a>
        </span>
    </div>

    <div class="layui-inline">
        <button type="button" id="submit" data-toggle="modal" data-target="#myModal"  class="layui-btn" >新增文章</button>
    </div>

    <table class="layui-table">
        <thead>
        <tr>
            <th>编号</th>
            <th>文章发布者</th>
            <th>文章标题</th>
            <th>文章信息</th>
            <th>创建时间</th>
            <th>修改时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($params as $v): ?>
            <tr>
                <td><?=$v['Article']['id']?></td>
                <td><?=$v['u']['username']?></td>
                <td><?=$v['Article']['title']?></td>
                <td><?=$v['Article']['content']?></td>
                <td><?= date('Y-m-d H:i:s',$v['Article']['create_time'])?></td>
                <td><?=date('Y-m-d H:i:s',$v['Article']['update_time'])?></td>
                <td>
                    <a class="layui-icon layui-icon-edit"  onclick="edit(<?=$v['Article']['id']?>,'<?=$v['Article']['title']?>','<?=$v['Article']['content']?>','<?=$v['u']['id']?>')" data-toggle="modal" data-target="#myModal"></a>
                    <a class="layui-icon layui-icon-subtraction" onclick="del(<?=$v['Article']['id']?>)"></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php if($pageCount > 1): ?>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li <?php if($page == 1 || !$page): ?> class="disabled" <?php endif; ?> >
            <a <?php if($page == 1 || !$page): ?>  onclick="return false" <?php endif; ?> href="/auth/index?page=<?= $page-1?>"  aria-label="Previous">
            <span aria-hidden="true"  >&laquo;</span>
            </a>
            </li>
            <?php for($i=0;$i<$pageCount;$i++): ?>
            <li <?php if($page == $i+1): ?> class="active" <?php endif; ?>><a href="/auth/index?page=<?= $i+1 ?>"><?=$i+1?></a></li>
            <?php endfor; ?>
            <li <?php if($page == $pageCount): ?> class="disabled" <?php endif; ?> >
            <a <?php if($page == $pageCount): ?> onclick="return false" <?php endif; ?>  href="/auth/index?page=<?= $page+1?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            </a>
            </li>
        </ul>
    </nav>
    <?php endif; ?>




    <div class="modal fade" id="myModal"  data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">文章管理</h4>
                </div>
                <div class="modal-body">
                    <div class="layui-form">
                        <div class="layui-form-item">
                            <label class="layui-form-label">文章id</label>
                            <div class="layui-input-block">
                                <input type="text" id="id1" hidden class="layui-input">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label" >文章标题</label>
                            <div class="layui-input-block">
                                <input type="text" id="title1" placeholder="请输入文章标题" class="layui-input">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label" >文章内容</label>
                            <div class="layui-input-block">
                                <div id="markdown">
                                    <textarea style="display: none;" id="content1"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">文章发布者</label>
                            <div class="layui-input-block">
                                <input type="hidden" id="user_id1">
                                <input type="text" id="user_name1" placeholder="请输入文章发布者" class="layui-input">
                            </div>
                        </div>

                    </div>
                </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                    <button type="button" id="ajax_submit1" class="btn btn-primary">提交</button>
                </div>
            </div>
        </div>
    </div>



</body>


<script src="https://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="/markdown/editormd.min.js" ></script>
<!--js开始-->


<script type="text/javascript">
    $(function() {
        var editor = editormd("markdown", {
            width  : "100%",
            height : "800px",
            markdown: "",
            path   : "/markdown/lib/"
        });
    });
    
    $('#ajax_submit1').click(function () {
        var data = {
           'id' : $('#id1').val(),
            'title': $('#title1').val(),
            'content': $('#content1').val(),
            'user_id' : $('#user_id1').val(),
        };
        $.ajax({
            'url' : '/article/dell',
            'data':data,
            'type':'post',
            'dataType':'Json',
            'success':function (res) {
                console.log(res);
            }
        })
    })

    function edit(id,title,content,user_id){
        $('#id1').val(id);
        $('#title1').val(title);
        $('#content1').val(content);
        $('#user_id1').val(user_id);
    }

</script>
<!--js结束-->

</html>