<?php
include_once "inc/config.inc.php";
include_once "inc/mysql.inc.php";
include_once "inc/tool.inc.php";
$template['title']='登陆界面';
$template['css']=array('style/public.css','style/register.css');
$link=connect();
//var_dump($_COOKIE);exit();
//var_dump(is_login($link));exit();
if(is_login($link)){
	skip('index.html','error','您已登陆');
}
if(isset($_POST['submit'])){
	$link=connect();
	include_once "inc/check_register.inc.php";
	$_POST['pw']=md5($_POST['pw']);
	$query="insert into sfk_member(name,pw,register_time) values('{$_POST['name']}','{$_POST['pw']}',now())";
	//var_dump($query);exit();
	$result=execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		setcookie('sfk[name]',$_POST['name']);
		setcookie('sfk[pw]',$_POST['pw']);
		skip('index.html','ok','会员注册成功');
	}else{
		skip('register.php','error','注册失败，请重试');
	}
	
}
?>
<?php include_once "inc/header.inc.php";?>
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
<?php include_once "inc/footer.inc.php";?>