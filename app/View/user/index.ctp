

<div style="margin-bottom: 5px">
    <span class="layui-breadcrumb">
          <a href="">首页</a>
          <a><cite>用户管理</cite></a>
    </span>
</div>


<button type="button" onclick="add()" class="layui-btn" data-toggle="modal" data-target="#myModal" >新增用户</button>
<table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="200">
            <col>
        </colgroup>
        <tr>
            <th>编号</th>
            <th>用户名</th>
            <th>密码</th>
            <th>手机号码</th>
            <th>邮箱</th>
            <th>昵称</th>
            <th>用户签名</th>
            <th>操作</th>
        </tr>
        <?php foreach($params as $v): ?>
            <tr>
                <td><?=$v['User']['id']?></td>
                <td><?=$v['User']['username']?></td>
                <td><?=$v['User']['password']?></td>
                <td><?=$v['User']['phone']?></td>
                <td><?=$v['User']['email']?></td>
                <td><?=$v['User']['nickname']?></td>
                <td><?=$v['User']['sign']?></td>
                <td>
                    <i class="layui-icon layui-icon-edit" data-toggle="modal" data-target="#myModal" onclick="add(<?=$v['User']['id']?>,'<?=$v['User']['username']?>', '<?=$v['User']['password']?>', '<?=$v['User']['phone']?>', '<?=$v['User']['email']?>', '<?=$v['User']['nickname']?>', '<?=$v['User']['sign']?>' )"></i>
                    <i class="layui-icon layui-icon-subtraction" onclick="del()"><a></a></i>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li <?php if($page == 1 || !$page): ?> class="disabled" <?php endif; ?> >
                    <a <?php if($page == 1 || !$page): ?>  onclick="return false" <?php endif; ?> href="/user/index?page=<?= $page-1?>"  aria-label="Previous">
                        <span aria-hidden="true"  >&laquo;</span>
                    </a>
                </li>
                    <?php for($i=0;$i<$pageCount;$i++): ?>
                        <li <?php if($page == $i+1): ?> class="active" <?php endif; ?>><a href="/user/index?page=<?= $i+1 ?>"><?=$i+1?></a></li>
                    <?php endfor; ?>
                <li <?php if($page == $pageCount): ?> class="disabled" <?php endif; ?> >
                    <a <?php if($page == $pageCount): ?> onclick="return false" <?php endif; ?>  href="/user/index?page=<?= $page+1?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

<div class="modal fade" id="myModal"  data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="close1()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">用户新增</h4>
            </div>
            <div class="modal-body">
                <div class="layui-form">

                    <div class="layui-form-item">
                        <label class="layui-form-label" >用户名</label>
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
                        <label class="layui-form-label" >手机号码</label>
                        <div class="layui-input-block">
                            <input type="text" id="phone" placeholder="请输入手机号码" class="layui-input">
                        </div>
                    </div>


                    <div class="layui-form-item">
                        <label class="layui-form-label" >签名</label>
                        <div class="layui-input-block">
                            <input type="text" id="nickname" placeholder="请输入用户昵称" class="layui-input">
                        </div>
                    </div>


                    <div class="layui-form-item">
                        <label class="layui-form-label" >签名</label>
                        <div class="layui-input-block">
                            <input type="text" id="sign" placeholder="请输入用户签名" class="layui-input">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="close1()"  data-dismiss="modal">返回</button>
                <button type="button" id="ajax_submit" class="btn btn-primary">提交</button>
            </div>
        </div>
    </div>
</div>


<script>
    layui.use('layer',function () {
        var layer = layui.layer;
        $('#ajax_submit').click(function () {
            var data = {
                'id' :  $('#id').val(),
                'username' :  $('#username').val(),
                'phone' :  $('#phone').val(),
                'email' : $('#email').val(),
                'nickname' : $('#nickname').val(),
                'sign' : $('#sign').val()
            };
            $.ajax({
                'url':'/user/dell',
                'data': data,
                'type':'post',
                'dataType':'json',
                'success':function (res) {
                    if (res.code == 200){
                        layer.msg('修改成功!' , {time: 800, icon:6});
                    } else {
                        layer.msg('修改失败!' , {time: 800, icon:5});
                    }
                    setTimeout(function () {
                        window.location.reload();
                    },800)
                }
            })
        })
    })

    function add(id='',username='',password='',phone='',email='',nickname='',sign=''){
        $('#id').val(id);
        $('#username').val(username);
        $('#phone').val(phone);
        $('#email').val(email);
        $('#nickname').val(nickname);
        $('#sign').val(sign);
        layui.use('layer', function(){
            var layer = layui.layer;
        });
    }


</script>

