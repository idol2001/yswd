<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?php echo $title ?> - 应试无敌后台管理系统</title>
	<link href="<?=base_url()?>/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<header><div id="logo">应试无敌后台管理系统</div><div id="user"><a href="#">xxx</a>, 欢迎你登录</div>
<div id="menu"><?php echo anchor('exams', '考试管理') ?> | <?php echo anchor('users', '用户管理')?></div>
<hr />
</header>