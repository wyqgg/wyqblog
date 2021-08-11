<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Login</title>

    <link rel="stylesheet" href="/css/layui/css/layui.css">
    <script src="/css/layui/layui.js"></script>
    <!--<script src="/css/layui/modules/layer.js"></script>-->
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
</head>
<body style="background-color:#5FB878">
<div>
    <h1 style="color: #fafafa;text-align: center;line-height: 80px">wyq博客系统后台登录</h1>
</div>
<div style="width: 30%;height: 60%;position: absolute;left:35%;top:15%;background-color:#FAFAFA">
    <div style="width: 100%;height: 20%;background-color: #009688;">
        <h1 style="color: #fafafa;text-align: center;line-height: 120px">管理员注册</h1>
    </div>
    <div style="padding: 40px;">
        <form class="layui-form" action="/admin/doRegist" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-block">
                    <input type="text" name="username" id="username"  placeholder="请输入用户名"  class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-block">
                    <input type="password" name="password" id="password"  placeholder="请输入密码"  class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">确认密码</label>
                <div class="layui-input-block">
                    <input type="password" name="password1" id="password1"  placeholder="请输入确认密码"  class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-block">
                    <input type="text" name="email" id="email" placeholder="请输入邮箱" style="width: 200px;"  class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">手机号码</label>
                <div class="layui-input-block">
                    <input type="text" name="phone" id="phone"  placeholder="请输入手机号码" style="width: 200px;"  class="layui-input">
                </div>
            </div>

            <a type="button" href="/login/login"  class="layui-btn" style="margin-left: 50px">去登录</a>
            <button type="button" id="submit"  class="layui-btn">注册</button>
        </form>
    </div>
</div>
</body>
</html>
<script>
    $("#submit").click(function () {
        if ($('#password').val() != $('#password1').val()) {
            layui.use('layer', function() {
                var layer = layui.layer;
                layer.msg('密码两次输入不同！');
            })
        }else{
            var data = {
                'username': $('#username').val(),
                'password': $('#password').val(),
                'phone': $('#phone').val(),
                'email': $('#email').val(),
                'nickname': $('#nickname').val(),
            };
            $.ajax({
                    'url': '/login/doRegist',
                    'type':'post',
                    'dataType':'json',
                    'data':data,
                    'success':function (msg) {
                        if (msg.code == 200){
                            layui.use('layer', function() {
                                var layer = layui.layer;
                                layer.msg('注册成功');
                            })
                            setTimeout(function(){
                                window.location.href ='/admin/login';
                            },800);
                        }else if (msg.code == 404){
                            layui.use('layer', function() {
                                var layer = layui.layer;
                                layer.msg(msg.data);
                            })
                        }
                    }
                });
        }
    })
</script>