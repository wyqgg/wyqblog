
<div style="margin-bottom: 5px">
    <span class="layui-breadcrumb">
          <a href="">首页</a>
          <a><cite>个人信息管理</cite></a>
    </span>
</div>

<form class="layui-form" action="/admin/alertAdmin" id="form" enctype="multipart/form-data" method="post">
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-block">
            <input type="hidden" name="id" id="id" value="<?=$admin_info['id']?>">
            <input type="text" value="<?=$admin_info['username']?>" id="username" name="username" lay-verify="required|username" lay-reqText="用户名不能为空" required placeholder="请输入用户名" autocomplete="off" class="layui-input" >
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">手机号</label>
        <div class="layui-input-block">
            <input type="text" name="phone" id="phone" value="<?=$admin_info['phone']?>" lay-verify="required|phone" lay-reqText="手机号不能为空" required placeholder="请输入手机号" autocomplete="off" class="layui-input" >
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">邮箱</label>
        <div class="layui-input-block">
            <input type="text" name="email" id="email" value="<?=$admin_info['email']?>" lay-verify="required|email" lay-reqText="邮箱不能为空" required placeholder="请输入邮箱" autocomplete="off" class="layui-input" >
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">头像</label>
        <input type="file" name="img" id="file"  onchange="changepic(this)">
        <img src="<?php echo $this->webroot; ?><?=$admin_info['image']?>"  id="img" style="margin-top:10px;width: 50px" accept="image/jpg,image/jpeg,image/png,image/PNG">
    </div>
    <button type="button" id="ajax_submit" class="layui-btn" style="margin-left: 100px">提交修改</button>
</form>

<script>

    function changepic() {
        $("#prompt3").css("display", "none");
        var reads = new FileReader();
        f = document.getElementById('file').files[0];
        reads.readAsDataURL(f);
        reads.onload = function(e) {
            document.getElementById('img').src = this.result;
            $("#img").css("display", "block");
        };
    }
    
    $('#ajax_submit').click(function () {
        var fd = new FormData();
        var file_data = $('#file').prop('files')[0];
        fd.append('img',file_data);
        fd.append('id',$('#id').val());
        fd.append('username',$('#username').val());
        fd.append('email',$('#email').val());
        fd.append('phone',$('#phone').val());

        $.ajax({
            'url':'/admin/alertAdmin',
            'contentType': false,
            'processData': false,
            'data':fd,
            'type':'post',
            'success':function (res) {
                if (res == 200){
                    layui.use('layer',function () {
                        var layer = layui.layer;
                        layer.msg('修改成功！');
                    })
                }else {
                    layui.use('layer',function () {
                        var layer = layui.layer;
                        layer.msg('修改失败！');
                    })
                }
                setTimeout(function () {
                    window.location.reload();
                },800);
            },
        })
    })
</script>