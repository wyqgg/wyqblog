

<div style="margin-bottom: 5px">
    <span class="layui-breadcrumb">
          <a href="">首页</a>
          <a><cite>管理员管理</cite></a>
    </span>
</div>

<button type="button"   class="layui-btn" data-toggle="modal" data-target="#myModal" >新增管理员</button>

<div style="height: 800px" class="modal-body">
    <table class="layui-table">
        <thead>
        <tr>
            <th>编号</th>
            <th>用户名</th>
            <th>角色</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($params as $v): ?>
        <tr>
            <td><?=$v['Admin']['id']?></td>
            <td><?=$v['Admin']['username']?></td>
            <td><?=$v['as']['role_name']?></td>
            <td><?=$v['Admin']['email']?></td>
            <td>
                <?php if($v['as']['id'] != 1): ?>
                <a class="layui-icon layui-icon-edit"  onclick="edit(<?=$v['Admin']['id']?>,'<?=$v['Admin']['username']?>','<?=$v['Admin']['email']?>',<?=$v['as']['id']?>)" data-toggle="modal" data-target="#myModal"></a>
                <a class="layui-icon layui-icon-subtraction" onclick="del(<?=$v['Admin']['id']?>)"></a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="modal fade" id="myModal"  data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="close1()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">权限修改</h4>
                </div>
                <div class="modal-body">
                    <div class="layui-form">

                        <div class="layui-form-item">
                            <label class="layui-form-label" >管理员名</label>
                            <div class="layui-input-block">
                                <input type="hidden" id="id"  class="layui-input">
                                <input type="text" id="username" placeholder="请输入管理员名" class="layui-input">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label" >邮箱</label>
                            <div class="layui-input-block">
                                <input type="text" id="email" placeholder="请输入邮箱地址" class="layui-input">
                            </div>
                        </div>


                        <div class="layui-form-item">
                            <label class="layui-form-label" >选择角色</label>
                            <div class="layui-input-block">
                                <select id="role" lay-filter="role" style="width: 120px">
                                    <option value="">请选择角色</option>
                                    <?php foreach($role as $v): ?>
                                        <option value="<?=$v['id']?>"><?=$v['role_name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="close1()" data-dismiss="modal">返回</button>
                    <button type="button" id="ajax_submit" class="btn btn-primary">提交</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    layui.use(['form'], function(){
        var form    = layui.form;

        $('#ajax_submit').click(function () {
            var data = {
                'id':$('#id').val(),
                'username':$('#username').val(),
                'email':$('#email').val(),
                'role_id':$('#role').val(),
            }

            $.ajax({
                'url':'/Admin/dellAdmin',
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

    function close1() {
        window.location.reload();
    }

    function edit(id,username,email,role_id) {
        $('#id').val(id);
        $('#username').val(username);
        $('#email').val(email);
        $('#role').val(role_id);
        layui.form.render();
    }
    
    function del(id) {
        var data = {
            'id':id
        }
        $.ajax({
            'url':'/Admin/delAdmin',
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