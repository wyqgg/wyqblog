<div style="margin-bottom: 5px">
        <span class="layui-breadcrumb">
              <a href="">首页</a>
              <a><cite>文章管理</cite></a>
        </span>
</div>

<button type="button" class="layui-btn" data-toggle="modal" data-target="#myModal">新增友情链接</button>

<table class="layui-table">
    <thead>
    <tr>
        <th>编号</th>
        <th>链接名</th>
        <th>链接地址</th>
        <th>创建时间</th>
        <th>修改时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($params as $v): ?>
    <tr>
        <td><?=$v['Link']['id']?></td>
        <td><?=$v['Link']['name']?></td>
        <td><?=$v['Link']['url']?></td>
        <td><?= date('Y-m-d H:i:s',$v['Link']['create_time'])?></td>
        <td><?=date('Y-m-d H:i:s',$v['Link']['update_time'])?></td>
        <td>
            <a class="layui-icon layui-icon-edit" data-toggle="modal" data-target="#myModal"
               onclick="edit(<?= $v['Link']['id'];?>,'<?= $v['Link']['name'];?>','<?= $v['Link']['url'];?>',<?= $v['Link']['status'];?>)"></a>
            <a class="layui-icon layui-icon-subtraction" onclick="del(<?= $v['Link']['id'];?>)"></a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>


<?php if($pageCount > 1): ?>
<nav aria-label="Page navigation">
    <ul class="pagination">
        <li
        <?php if($page == 1 || !$page): ?> class="disabled" <?php endif; ?> >
        <a <?php if($page == 1 || !$page): ?>  onclick="return false" <?php endif; ?>
        href="/auth/index?page=<?= $page-1?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        </a>
        </li>
        <?php for($i=0;$i<$pageCount;$i++): ?>
        <li
        <?php if($page == $i+1): ?> class="active" <?php endif; ?>><a
            href="/auth/index?page=<?= $i+1 ?>"><?=$i+1?></a></li>
        <?php endfor; ?>
        <li
        <?php if($page == $pageCount): ?> class="disabled" <?php endif; ?> >
        <a <?php if($page == $pageCount): ?> onclick="return false" <?php endif; ?>
        href="/auth/index?page=<?= $page+1?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        </a>
        </li>
    </ul>
</nav>
<?php endif; ?>

<div class="modal fade" id="myModal" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="close1()" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">友情链接操作</h4>
            </div>
            <div class="modal-body">
                <form class="layui-form" action="">

                    <div class="layui-form-item">
                        <label class="layui-form-label">链接名</label>
                        <div class="layui-input-block">
                            <input type="hidden" id="id" class="layui-input">
                            <input type="text" id="name" placeholder="请输入链接名" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">链接url</label>
                        <div class="layui-input-block">
                            <input type="text" id="url" placeholder="请输入链接url" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">链接状态</label>
                        <div class="layui-input-block">
                            <input type="checkbox" checked="true" id="status" name="open" lay-skin="switch"
                                   lay-filter="switchTest"
                                   lay-text="显示|隐藏">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="close1()" data-dismiss="modal">返回</button>
                <button type="button" id="ajax_submit" class="btn btn-primary">提交</button>
            </div>
        </div>
    </div>
</div>
<script>
    layui.use('form', function () {
        var form = layui.form;

        $('#ajax_submit').click(function () {
            sta = 0;
            if ($('#status').is(':checked')){
                var sta = 1;
            }
            var data = {
                'id': $('#id').val(),
                'name': $('#name').val(),
                'url': $('#url').val(),
                'status' : sta,
            }
            $.ajax({
                url: '/link/add',
                data: data,
                type: 'Post',
                dataType: 'Json',
                success: function (res) {
                    if (res.code == 200) {
                        layer.msg('操作成功');
                    } else {
                        layer.msg('操作失败');
                    }
                    setTimeout(function () {
                        window.location.reload();
                    }, 800);
                }
            });
        })
    });

    function edit(id, name, url, status) {
        $('#id').val(id);
        $('#name').val(name);
        $('#url').val(url);
        console.log(url);
        var sta = false;
        if (status == 1) {
            sta = true;
        }
        console.log(sta);
        $('#status').prop("checked", sta);
        layui.form.render();
    };

    function close1() {
        window.location.reload();
    };

    function del(id) {
        var data = {
            'id': id,
        };
        $.ajax({
            url: '/link/del',
            data: data,
            type: 'post',
            dataType: 'json',
            success: function (res) {
                console.log(res.code);
                if (res.code == 200) {
                    layer.msg("删除成功");
                } else {
                    layer.msg("删除失败");
                }
                setTimeout(function () {
                    window.location.reload();
                },800)
            }
        });
    };

</script>