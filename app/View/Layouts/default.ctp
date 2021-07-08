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
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
</head>

<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">

		<div class="layui-header">
			<div class="layui-logo">layui 后台布局</div>
			<!-- 头部区域（可配合layui已有的水平导航） -->
			<ul class="layui-nav layui-layout-left">
				<li class="layui-nav-item"><a href="">控制台</a></li>
				<li class="layui-nav-item"><a href="">商品管理</a></li>
				<li class="layui-nav-item"><a href="">用户</a></li>
				<li class="layui-nav-item">
					<a href="javascript:;">其它系统</a>
					<dl class="layui-nav-child">
						<dd><a href="">邮件管理</a></dd>
						<dd><a href="">消息管理</a></dd>
						<dd><a href="">授权管理</a></dd>
					</dl>
				</li>
			</ul>
			<ul class="layui-nav layui-layout-right">
				<li class="layui-nav-item">
					<a href="javascript:;">
						<img src="http://t.cn/RCzsdCq" class="layui-nav-img">
						贤心
					</a>
					<dl class="layui-nav-child">
						<dd><a href="">基本资料</a></dd>
						<dd><a href="">安全设置</a></dd>
					</dl>
				</li>
				<li class="layui-nav-item"><a href="">退了</a></li>
			</ul>
		</div>

		<div class="layui-side layui-bg-black">
		<div class="layui-side-scroll">
			<!-- 左侧导航区域（可配合layui已有的垂直导航） -->
			<ul class="layui-nav layui-nav-tree"  lay-filter="test">
				<li class="layui-nav-item layui-nav-itemed">
					<a class="" href="javascript:;">所有商品</a>
					<dl class="layui-nav-child">
						<dd><a href="javascript:;">列表一</a></dd>
						<dd><a href="javascript:;">列表二</a></dd>
						<dd><a href="javascript:;">列表三</a></dd>
						<dd><a href="">超链接</a></dd>
					</dl>
				</li>
				<li class="layui-nav-item">
					<a href="javascript:;">解决方案</a>
					<dl class="layui-nav-child">
						<dd><a href="javascript:;">列表一</a></dd>
						<dd><a href="javascript:;">列表二</a></dd>
						<dd><a href="">超链接</a></dd>
					</dl>
				</li>
				<li class="layui-nav-item"><a href="">云市场</a></li>
				<li class="layui-nav-item"><a href="">发布商品</a></li>
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
