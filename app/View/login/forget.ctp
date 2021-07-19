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
        <h1 style="color: #fafafa;text-align: center;line-height: 80px">密码找回</h1>
    </div>
    <div style="padding: 40px;">
        <form class="layui-form" >

            <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-block">
                    <input type="text" id="username" name="username"  placeholder="请输入已注册的用户名"  class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">邮箱地址</label>
                <div class="layui-input-inline">
                    <input type="text" id="email" name="username"  placeholder="请输入已注册的邮箱"  class="layui-input">
                </div>
                <button id="fun" type="button"  class="layui-btn" >发送验证码</button>
            </div>



            <div class="layui-form-item">
                <label class="layui-form-label">邮箱验证码</label>
                <div class="layui-input-block">
                    <input type="text" name="code" id="code" placeholder="请输入验证码" style="width: 200px;"  class="layui-input">
                </div>
            </div>

            <button id="submit" type="button" class="layui-btn" style="margin-left: 80px;margin-top: 20px">验证</button>
            <a type="button"  href="/login/regist" style="margin-left: 250px;margin-top: 20px"  class="layui-btn">去注册</a>
        </form>
    </div>
</div>
</body>
</html>

    <script>
        $('#fun').click(function () {
             //ajax调用发送邮箱方法
             var data = {
                'email':$('#email').val(),
                'username':$('#username').val(),
             }
            $.ajax({
                'url':'/login/findPsw',
                'data':data,
                'type':'post',
                'dataType':'Json',
                'success':function (res) {
                    if (res == 200){
                        layui.use('layer',function () {
                            var layer = layui.layer;
                            layer.msg("发送成功！");
                        });
                        $('#fun').addClass('layui-btn-disabled');
                        $('#fun').attr('disabled',true);
                        var t = parseInt(59);
                        var time =  setInterval(function () {
                            $('#fun').html(t+'s');
                            t--;
                            if (t == 0){
                                $('#fun').removeClass('layui-btn-disabled');
                                $('#fun').attr('disabled',false);
                                $('#fun').html('发送验证码');
                                clearInterval(time);
                            }
                        },1000)
                    } else if (res == 400) {
                        layui.use('layer',function () {
                            var layer = layui.layer;
                            layer.msg("邮箱发送失败！");
                        });
                    }else{
                        layui.use('layer',function () {
                            var layer = layui.layer;
                            layer.msg("用户名或邮箱错误！");
                        });
                    }
                }
            })
         })
        layui.use('layer',function () {
            $('#submit').click(function () {
                var data = {
                    'username' : $('#username').val(),
                    'email': $('#email').val(),
                    'code':$('#code').val(),
                }

                $.ajax({
                    'url':'/login/submitPsw',
                    'data':data,
                    'dataType':'json',
                    'type':'post',
                    'success':function (res) {
                        if (res == 200){
                            layer.msg("密码已重置为验证邮箱前六位！");
                            setTimeout(function () {
                                window.location.href = "/login/login";
                            },800)
                        } else {
                            layer.msg("验证失败！");
                        }
                    }
                })
            })
        })
    </script>