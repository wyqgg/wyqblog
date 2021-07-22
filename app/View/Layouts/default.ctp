<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>



	<link rel="stylesheet" href="/css/layui/css/layui.css">
	<script src="/css/layui/layui.js"></script>
	<!--<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>-->
	<script src="https://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

	<style type="text/css">

		.layui-form-label {
			width: 200px !important;
			text-align: center !important;
		}

		.layui-input-block {
			margin-left: 200px !important;
		}

	</style>

</head>

<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">

		<div class="layui-header" style="z-index: 50">
			<div class="layui-logo layui-hide-xs layui-bg-black">layui 后台布局</div>
			<!-- 头部区域（可配合layui已有的水平导航） -->

			<ul class="layui-nav layui-layout-right" >
				<li class="layui-nav-item layui-hide layui-show-md-inline-block">
					<a href="javascript:;">
						<img src="<?php echo $this->webroot; ?><?php echo $admin_info['image'] ?> " class="layui-nav-img">
						<?php echo $admin_info['username'] ?>
					</a>
				</li>
				<li class="layui-nav-item"><a  id="logout" >退出登录</a></li>
			</ul>
		</div>

		<div class="layui-side layui-bg-black">

		<div class="layui-side-scroll" style="z-index: 50">
			<!-- 左侧导航区域（可配合layui已有的垂直导航） -->

			<ul class="layui-nav layui-nav-tree" >
				<?php foreach($menu as $v): ?>
				<li class="layui-nav-item ">
					<a class="" href="javascript:;"><?= $v['auth_name'] ?></a>
					<dl class="layui-nav-child ">
						<?php foreach($v['son'] as $v1): ?>
						<!---->
							<dd><a href="<?= $v1['path'] ?>"><?= $v1['auth_name'] ?></a></dd>
						<?php endforeach;  ?>
					</dl>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>

		<div id="content" class="layui-body" style="padding: 15px;margin-top: 60px;">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>





</body>
</html>
<script>
	layui.use(['element', 'layer', 'util'], function(){
	});

	$('#logout').click(function () {
		$.ajax({
			'url':'/login/logout',
			'type':'post',
			'dataType':'json',
			'success':function (res) {
				console.log(res);
				if (res == true){
						layui.use('layer',function () {
							var layer = layui.layer;
							layer.msg('登出成功');
						})
					setTimeout(function () {
						window.location.href='/login/login';
					},600)
				}

			}
		});
	})



</script>
