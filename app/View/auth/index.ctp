

<div style="margin-bottom: 5px">
    <span class="layui-breadcrumb">
          <a href="">首页</a>
          <a><cite>权限管理</cite></a>
    </span>
</div>

    <div style="height: 800px" class="modal-body">
        <div class="layui-form">

            <div class="layui-inline">
                <input type="text" id="auth_name" style="width: 120px;" placeholder="请输入权限名" class="layui-input">
            </div>

            <div class="layui-inline">
                <select id="is_menu" lay-filter="is_menu" style="width: 120px;">
                    <option value="1">是否菜单权限(默认是)</option>
                    <option value="1">是</option>
                    <option value="0">否</option>
                </select>
            </div>

            <div class="layui-inline">
                <input type="text" id="path" style="width: 120px;" placeholder="请输入url地址" class="layui-input">
            </div>
            <div class="layui-inline">
                <select id="auth" lay-filter="auth" style="width: 290px;">
                    <option value="0">请选择菜单(默认顶级菜单)</option>
                    <?php foreach($rootMenu as $v): ?>
                        <option value="<?= $v['Auth']['id'] ?>"><?= $v['Auth']['auth_name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="layui-inline">
                <button type="button" id="submit"  class="layui-btn" >新增权限</button>
            </div>
        </div>

        <table class="layui-table">
        <thead>
            <tr>
                <th>编号</th>
                <th>权限名</th>
                <th>控制器方法名</th>
                <th>是否菜单权限</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($params as $v): ?>
            <?php if($v['Auth']['pid'] != 0): ?>
            <tr data-pid = "<?=$v['Auth']['pid']?>">
                <td><?=$v['Auth']['id']?></td>
                <td><?=$v['Auth']['auth_name']?></td>
                <td><?=$v['Auth']['path']?></td>
                <td><?php if($v['Auth']['is_menu'] == 1):?>是<?php else: ?>否<?php endif; ?></td>
                <td>
                    <a class="layui-icon layui-icon-edit"  onclick="edit(<?=$v['Auth']['id']?>,'<?=$v['Auth']['auth_name']?>','<?=$v['Auth']['path']?>',<?=$v['Auth']['is_menu']?>,'<?=$v['Auth']['pid']?>')" data-toggle="modal" data-target="#myModal"></a>
                    <a class="layui-icon layui-icon-subtraction" onclick="del(<?=$v['Auth']['id']?>)"></a>
                </td>
            </tr>
            <?php endif; ?>
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
                        <h4 class="modal-title" id="myModalLabel">权限修改</h4>
                    </div>
                    <div class="modal-body">
                        <div class="layui-form">
                            <div class="layui-form-item">
                                <label class="layui-form-label">权限id</label>
                                <div class="layui-input-block">
                                    <input type="text" id="id" disabled class="layui-input">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label" >权限名</label>
                                <div class="layui-input-block">
                                    <input type="text" id="auth_name1" placeholder="请输入权限名" class="layui-input">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label" >是否菜单权限</label>
                                <div class="layui-input-block">
                                    <select id="is_menu1" lay-filter="is_menu" style="width: 120px">
                                        <option value="1">是否菜单权限(默认是)</option>
                                        <option value="1">是</option>
                                        <option value="0">否</option>
                                    </select>
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">url地址</label>
                                <div class="layui-input-block">
                                    <input type="text" id="path1" placeholder="请输入url地址" class="layui-input">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">父级权限</label>
                                <div class="layui-input-block">
                                    <select id="auth1" lay-filter="auth1" >
                                        <option value="0">请选择菜单(默认顶级菜单)</option>
                                        <?php foreach($rootMenu as $v): ?>
                                            <option value="<?= $v['Auth']['id'] ?>"><?= $v['Auth']['auth_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
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
    </div>
<script>

    layui.use(['form', 'layedit', 'laydate'], function(){
        var layedit = layui.layedit;
        var laydate = layui.laydate;
        var form    = layui.form;
        form.on('select(auth)', function(data) {
            var val = data.value;
            $("tbody tr").each(function () {
                if (val == ""){
                    $(this).show(60);
                    return;
                }
                if (val ==$(this).data('pid')) {
                    $(this).show(60);
                    return;
                }
                $(this).hide(60);
            })
        });
    });

    //新增ajax
    $("#submit").click(function () {
        var data = {
            'pid':$('#auth').val(),
            'auth_name':$('#auth_name').val(),
            'path':$('#path').val(),
            'is_menu':$('#is_menu').val(),
        }
        $.ajax({
            'url':'/auth/addAuth',
            'type':'post',
            'dateType':'json',
            'data':data,
            'success':function (code) {
                console.log(code);
                if (code == 200){
                    layui.use('layer',function () {
                        var layer = layui.layer;
                        layer.msg('新增成功');
                    })
                    setTimeout(function(){
                        window.location.reload();
                    },800);
                }else {
                    layui.use('layer',function () {
                        var layer = layui.layer;
                        layer.msg('新增失败');
                    })
                }
            }
        })
    })

    //加载模态框
    function edit(id,auth_name,path,is_menu,pid) {
        $("#id").val(id);
        $("#auth_name1").val(auth_name);
        $("#path1").val(path);
        $("#is_menu1").val(is_menu);
        $("#auth1").val(pid);
        layui.form.render();
    }

    //修改ajax
    $("#ajax_submit1").click(function () {
        var data = {
            'id':$("#id").val(),
            'auth_name':$("#auth_name1").val(),
            'path':$("#path1").val(),
            'is_menu':$("#is_menu1").val(),
            'pid':$("#auth1").val(),
        };
        $.ajax({
            'url': '/auth/editAuth',
            'type':'post',
            'data':data,
            'dataType':"json",
            'success':function (res) {
                if (res == 200){
                    layui.use('layer',function () {
                        var layer = layui.layer;
                        layer.msg("修改成功!");
                    })
                } else {
                    layui.use('layer',function () {
                        var layer = layui.layer;
                        layer.msg("修改失败!");
                    })
                }
                setTimeout(function () {
                   window.location.reload();
                },800)
            }
        })
    })
    
    //删除
    function del(id) {
        var data ={'id':id};
        $.ajax({
            'url':'/auth/delAuth',
            'type':'post',
            'dataType': 'json',
            'data': data,
            'success':function (res) {
                if (res == 200){
                    layui.use('layer',function () {
                        var layer = layui.layer;
                        layer.msg("删除成功")
                    })
                } else {
                    layui.use('layer',function () {
                        var layer = layui.layer;
                        layer.msg("删除失败")
                    })
                }
                setTimeout(function () {
                    window.location.reload();
                },800);
            }
        });
    }

</script>