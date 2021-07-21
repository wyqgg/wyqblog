<div class="layui-form">

    <div class="layui-form-item">
        <label class="layui-form-label" >旧密码</label>
        <div class="layui-input-block">
            <input type="hidden" id="id" value="<?=$admin_info['id']?>" class="layui-input">
            <input type="password" id="password" placeholder="请输入旧密码" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label" >新密码</label>
        <div class="layui-input-block">
            <input type="password" id="password1" placeholder="请输入新密码" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label" >确认密码</label>
        <div class="layui-input-block">
            <input type="password" id="password2" placeholder="请输入确认密码" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="button" id="ajax_submit" class="layui-btn">提交</button>
        </div>
    </div>

</div>

<script>
layui.use('layer',function () {
    $("#ajax_submit").click(function () {
        var data = {
            'id'        : $('#id').val(),
            'password'  : $('#password').val(),
            'password1' : $('#password1').val(),
            'password2' : $('#password2').val(),
        };
        $.ajax({
            'url'       : '/admin/dellPassword',
            'data'      : data,
            'type'      : 'Post',
            'dataType'  : 'json',
            'success'   : function (res) {
                if (res.code == 200){
                    layer.msg('修改成功！',{'code':200,'icon':6});
                }
                if (res.code == 501){
                    layer.msg('密码不能为空！',{'code':200,'icon':5});
                }
                if (res.code == 502){
                    layer.msg('两次输入密码不同！',{'code':200,'icon':5});
                }
                if (res.code == 503) {
                    layer.msg('原密码错误！',{'code':200,'icon':5});
                }
                if (res.code == 504) {
                    layer.msg('修改失败！',{'code':200,'icon':5});
                }
            }
        });
    })
})

</script>