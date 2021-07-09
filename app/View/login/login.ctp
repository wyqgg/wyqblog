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
    <div style="width: 30%;height: 40%;position: absolute;left:35%;top:30%;background-color:#FAFAFA">
        <div style="width: 100%;height: 20%;background-color: #009688;">
                <h1 style="color: #fafafa;text-align: center;line-height: 80px">管理员登录</h1>
        </div>
        <div style="padding: 40px;">
            <form class="layui-form" action="/admin/doLogin" method="post">
                <div class="layui-form-item">
                    <label class="layui-form-label">用户名</label>
                    <div class="layui-input-block">
                        <input type="text" id="username" name="username"  placeholder="请输入用户名"  class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-block">
                        <input type="password" id="password" name="password"  placeholder="请输入密码"  class="layui-input">
                    </div>
                </div>

                <!--<div class="layui-form-item">-->
                    <!--<label class="layui-form-label">验证码</label>-->
                    <!--<div class="layui-input-block">-->
                        <!--<input type="text" name="code"  placeholder="请输入验证码" style="width: 200px;"  class="layui-input">-->
                    <!--</div>-->
                <!--</div>-->

                <button id="submit" type="button" class="layui-btn" style="margin-left: 50px">登录</button>
                <a type="button"  href="/login/regist"   class="layui-btn">注册</a>
            </form>
        </div>
    </div>
</body>
</html>

    <script>
    $("#submit").click(function () {
            var data = {
                'username': $('#username').val(),
                'password': $('#password').val(),
            };
            $.ajax({
                    'url': '/login/doLogin',
                    'type':'post',
                    'dataType':'json',
                    'data':data,
                    'success':function (msg) {
                        if (msg.code == 200){
                            layui.use('layer', function() {
                                var layer = layui.layer;
                                layer.msg('登录成功');
                            })
                            setTimeout(function(){
                                window.location.href ='/user/index';
                            },800);
                        }else if(msg.code == 400){
                            layui.use('layer', function() {
                                var layer = layui.layer;
                                layer.msg(msg.msg);
                            })
                        }
                    }
                }
            )
        }
    )
    </script>