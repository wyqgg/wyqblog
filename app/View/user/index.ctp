
<button type="button" onclick="add()" class="layui-btn" >新增用户</button>
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
                    <i class="layui-icon layui-icon-edit" onclick="add(<?=$v['User']['id']?>,'<?=$v['User']['username']?>', '<?=$v['User']['password']?>', '<?=$v['User']['phone']?>', '<?=$v['User']['email']?>', '<?=$v['User']['nickname']?>', '<?=$v['User']['sign']?>' )"></i>
                    <i class="layui-icon layui-icon-subtraction" onclick="del()"><a></a></i>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>




<script>
    function add(id='',username='',password='',phone='',email='',nickname='',sign=''){
        layui.use('layer', function(){
            var layer = layui.layer;
            layer.open({
                //layer提供了5种层类型。可传入的值有：0（信息框，默认）1（页面层）2（iframe层）3（加载层）4（tips层）
                type:1,
                title:"添加用户信息",
                area: ['60%','60%'],
                content:"<div id=\"addModel\" style=\"\">\n" +
                    "        <form class=\"form-horizontal\" action='/user/dell' method='post'>\n" +
                    "\n" +
                        "<input type='hidden' name='id' value="+id+">"+
                    "            <div class=\"form-group\">\n" +
                    "                <label  class=\"col-sm-2 control-label\">用户名</label>\n" +
                    "                <div class=\"col-sm-10\">\n" +
                    "                    <input id=\"username\" class=\"form-control\" name=\"username\" placeholder=\"用户名\" value="+username+">\n" +
                    "                </div>\n" +
                    "            </div>\n" +
                    "\n" +
                    "            <div class=\"form-group\">\n" +
                    "                <label  class=\"col-sm-2 control-label\">密码</label>\n" +
                    "                <div class=\"col-sm-10\">\n" +
                    "                    <input id=\"password\"  class=\"form-control\" name=\"password\" placeholder=\"密码\" value="+password+">\n" +
                    "                </div>\n" +
                    "            </div>\n" +
                    "\n" +
                    "            <div class=\"form-group\">\n" +
                    "                <label  class=\"col-sm-2 control-label\">邮箱</label>\n" +
                    "                <div class=\"col-sm-10\">\n" +
                    "                    <input id=\"email\" class=\"form-control\" name=\"email\" placeholder=\"邮箱\" value="+email+">\n" +
                    "                </div>\n" +
                    "            </div>\n" +
                    "\n" +
                    "            <div class=\"form-group\">\n" +
                    "                <label  class=\"col-sm-2 control-label\">手机号码</label>\n" +
                    "                <div class=\"col-sm-10\">\n" +
                    "                    <input id=\"phone\" class=\"form-control\" name=\"phone\" placeholder=\"手机号码\" value="+phone+">\n" +
                    "                </div>\n" +
                    "            </div>\n" +
                    "\n" +
                    "            <div class=\"form-group\">\n" +
                    "                <label  class=\"col-sm-2 control-label\">昵称</label>\n" +
                    "                <div class=\"col-sm-10\">\n" +
                    "                    <input id=\"nickname\" class=\"form-control\" name=\"nickname\" placeholder=\"昵称\" value="+nickname+">\n" +
                    "                </div>\n" +
                    "            </div>\n" +
                    "\n" +
                    "            <div class=\"form-group\">\n" +
                    "                <label  class=\"col-sm-2 control-label\">个性签名</label>\n" +
                    "                <div class=\"col-sm-10\">\n" +
                    "                    <input id=\"sign\" class=\"form-control\" name=\"sign\" placeholder=\"个性签名\" value="+sign+">\n" +
                    "                </div>\n" +
                    "            </div>\n" +
                    "\n" +
                    "\n" +
                    "            <div class=\"form-group\">\n" +
                    "                <div class=\"col-sm-offset-2 col-sm-10\">\n" +
                    "                    <button type=\"submit\" class=\"btn btn-default\">提交</button>\n" +
                    "                </div>\n" +
                    "            </div>\n" +
                    "        </form>\n" +
                    "    </div>"
            });
        });
    }
</script>

