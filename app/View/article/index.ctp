<div style="margin-bottom: 5px">
        <span class="layui-breadcrumb">
              <a href="">首页</a>
              <a><cite>文章管理</cite></a>
        </span>
</div>

<table class="layui-table">
    <thead>
    <tr>
        <th>编号</th>
        <th>文章发布者</th>
        <th>文章标题</th>
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
        <td><?= date('Y-m-d H:i:s',$v['Article']['create_time'])?></td>
        <td><?=date('Y-m-d H:i:s',$v['Article']['update_time'])?></td>
        <td>
            <a class="layui-icon layui-icon-edit" href="/article/showDell?id=<?=$v['Article']['id'];?>' "></a>
            <a class="layui-icon layui-icon-subtraction" onclick="del(<?= $v['Article']['id'];?>)"></a>
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


<script>
    function del(id) {
        var url = '/article/del/';
        var data = {
            'id': id,
        }
        $.ajax({
            'url': url,
            'data': data,
            'type': 'Post',
            'dataType': 'Json',
            'success': function (res) {
                layui.use(['layer'], function () {
                    var layer = layui.layer;
                    if (res.code == 200) {
                        layer.msg('删除成功');
                    } else {
                        layer.msg('删除失败');
                    }
                    setTimeout(function () {
                        window.location.reload();
                    }, 800);
                })
            }
        });
    }
</script>