
<div style="margin-bottom: 5px">
    <span class="layui-breadcrumb">
          <a href="">首页</a>
          <a><cite>角色管理</cite></a>
    </span>
</div>

<button type="button" onclick="add()" class="layui-btn" data-toggle="modal" data-target="#myModal" >新增角色</button>

<table class="layui-table">
    <colgroup>
        <col width="150">
        <col width="200">
        <col>
    </colgroup>
    <tr>
        <th>编号</th>
        <th>角色名</th>
        <th>管理员列表</th>
        <th>描述</th>
        <th>操作</th>
    </tr>
    <?php foreach($params as $v): ?>
    <tr>
        <td><?=$v['Role']['id']?></td>
        <td><?=$v['Role']['role_name']?></td>
        <td><?=$v['Role']['name']?></td>
        <td><?=$v['Role']['desc']?></td>
        <td>
            <?php if($v['Role']['id'] == 1): ?>
            <?php else: ?>
                <a class="layui-icon layui-icon-edit" data-toggle="modal" data-target="#myModal" onclick="edit(<?= $v['Role']['id']?>,'<?= $v['Role']['role_name']?>','<?= $v['Role']['desc']?>')"></a>
                <a class="layui-icon layui-icon-subtraction" onclick="del(<?= $v['Role']['id']?>)"></a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="modal fade" id="myModal"  data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="close1()"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">角色操作</h4>
            </div>
            <div class="modal-body">
                <div class="layui-form" style="width: 60%;margin-top: 20px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label">角色名</label>
                        <div class="layui-input-block">
                            <input type="hidden" id="id" class="layui-input">
                            <input type="text" id="username" placeholder="请输入角色名" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label" >角色描述</label>
                        <div class="layui-input-block">
                            <input type="text" id="desc" placeholder="请输入角色描述" class="layui-input">
                        </div>
                    </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label" >网站权限</label>
                            <div class="layui-input-block layui-tab layui-tab-brief" style="width: 500px" lay-filter="demo">
                                <ul class="layui-tab-title">
                                        <?php foreach($auth as $v1): ?>
                                            <?php if($v1['pid'] == 0): ?>
                                                <li data-id="<?=$v1['id']?>"><?=$v1['auth_name'];?></li>
                                            <?php endif; ?>
                                        <?php endforeach;  ?>
                                </ul>
                                <div class="layui-tab-content">
                                    <?php foreach($auth as $v1): ?>
                                        <?php if($v1['pid'] == 0): ?>
                                            <div class="layui-tab-item">
                                                <?php foreach($auth as $v2): ?>
                                                        <?php if($v1['id'] == $v2['pid'] ): ?>
                                                            <input type="checkbox" name="auth" lay-skin="primary" value="<?= $v2['id']?>" title="<?=$v2['auth_name']?>">
                                                    <?php endif; ?>
                                                <?php endforeach;  ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach;  ?>
                                </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="close1()" data-dismiss="modal">返回</button>
                <button type="button" id="ajax_submit1" class="btn btn-primary">提交</button>
            </div>
        </div>
    </div>
</div>

<script>
    //关闭模态框重新加载
    function close1(){
        window.location.reload();
    }
    //layui加载
    layui.use(['element','form','layer'],function(){
        var element = layui.element;
        var form = layui.form;
        var layer = layui.layer;

        //提交修改
        $("#ajax_submit1").click(function () {
            var auth_array = new Array();
            $('input[name=auth]:checked').each(function () {
                auth_array.push($(this).val());
            });
            var auth_str = auth_array.join(',');
            //数据
            var data = {
                'id':$('#id').val(),
                'role_name':$('#username').val(),
                'desc':$('#username').val(),
                'auth_ids':auth_str,
            }
            $.ajax({
                'url':'/Role/dellRole',
                'data':data,
                'type':'post',
                'dataType':'json',
                'success':function (res) {
                    if (res.code == 400){
                        layer.msg("操作失败!");
                    }else if(res.code == 200){
                        layer.msg("操作成功!");
                    }
                    setTimeout(function () {
                        window.location.reload();
                    },800)
                }
            });
        })

    });
    //点击修改时加载
    function edit(role_id,role_name,desc) {
        var data ={
            'role_id':role_id,
        };
        $("#username").val(role_name);
        $("#desc").val(desc);

        $('#id').val(role_id);
        $.ajax({
            'url': '/Role/roleFindRole',
            'type':'post',
            'data':data,
            'dataType':'JSON',
            'success':function (res) {
                var array = new Array();
                $.each(res,function (data,value) {
                    array.push(parseInt(value));
                });

                $('input[name=auth]').each(function () {
                    var cat = parseInt($(this).val());
                    if ($.inArray(cat,array) != -1) {
                        $(this).attr("checked",true);
                        layui.form.render();
                    }
                });
            },
        });
    }
    //删除角色信息
    function del(role_id) {
        var data = {
            'role_id':role_id
        }
        $.ajax({
            'url':'/Role/delRole',
            'type':'post',
            'dataType':'Json',
            'data':data,
            'success':function (res) {
                if (res.code ==200){
                    layui.use('layer',function () {
                        var layer = layui.layer;
                        layer.msg('删除成功');
                    })
                }else{
                    layui.use('layer',function () {
                        var layer = layui.layer;
                        layer.msg('删除失败');
                    })
                }
                setTimeout(function () {
                    window.location.reload();
                },800);
            }
        });
    }
</script>