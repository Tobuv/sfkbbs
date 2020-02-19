<?php
include_once "inc/config.inc.php";
include_once "inc/mysql.inc.php";
include_once "inc/tool.inc.php";
if(isset($_POST['submit'])){
	$link=connect();
	include_once "inc/check_register.inc.php";
	$_POST['pw']=md5($_POST['pw']);
	$query="insert into sfk_member(name,pw,register_time) values('{$_POST['name']}','{$_POST['pw']}',now())";
	//var_dump($query);exit();
	$result=execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		skip('index.html','ok','会员注册成功');
	}else{
		skip('register.php','error','注册失败，请重试');
	}
	
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="stylesheet" type="text/css" href="style/public.css" />
<link rel="stylesheet" type="text/css" href="style/register.css" />
</head>
<body>
	<div class="header_wrap">
		<div id="header" class="auto">
			<div class="logo">sifangku</div>
			<div class="nav">
				<a class="hover">首页</a>
				<a>新帖</a>
				<a>话题</a>
			</div>
			<div class="serarch">
				<form>
					<input class="keyword" type="text" name="keyword" placeholder="搜索其实很简单" />
					<input class="submit" type="submit" name="submit" value="" />
				</form>
			</div>
			<div class="login">
				<a>登录</a>&nbsp;
				<a>注册</a>
			</div>
		</div>
	</div>
	<div style="margin-top:55px;"></div>
	<div id="register" class="auto">
		<h2>欢迎注册成为 私房库会员</h2>
		<form method="post">
			<label>用户名：<input type="text" name="name"  /><span>*用户名不得超过32个字符</span></label>
			<label>密码：<input type="password" name="pw"  /><span>*密码不得少于6位</span></label>
			<label>确认密码：<input type="password" name="confirm_pw"  /><span>*密码不得少与六位</span></label>
			<label>验证码：<input name="vcode" type="text" name="vcode" /><span>*请输入下方验证码</span></label>
			<img class="vcode" src="inc/vcode.inc.php" />
			<div style="clear:both;"></div>
			<input class="btn" type="submit" name="submit" value="确定注册" />
		</form>
	</div>
	<div id="footer" class="auto">
		<div class="bottom">
			<a>私房库</a>
		</div>
		<div class="copyright">Powered by sifangku ©2020 sifangku.com</div>
	</div>
</body>
</html>