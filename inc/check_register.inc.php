<?php
$_POST=escape($link,$_POST);
if(empty($_POST['name'])){
    skip('register.php','error','用户名不得为空');
}
if(mb_strlen($_POST['name'])>32){
    skip('register.php','error','用户名不得多于32个字符');
}
if(mb_strlen($_POST['pw'])<6){
    skip('register.php','error','密码不得少于6位');
}
if($_POST['pw']!=$_POST['confirm_pw']){
    skip('register.php','error','两次密码不一致');
}
if(strtolower($_SESSION['vcode'])!=strtolower($_POST['vcode'])){
    skip('register.php','error','验证码有误');
}
$query="select * from sfk_member where name='{$_POST['name']}'";
$result=execute($link,$query);
if(mysqli_num_rows($result)){
    skip('register.php','error','用户名已存在');
}

?>