<?php
$_POST=escape($link,$_POST);
if(empty($_POST['name'])){
    skip('login.php','error','用户名不得为空');
}
if(mb_strlen($_POST['name'])>32){
    skip('login.php','error','用户名不得多于32个字符');
}
if(mb_strlen($_POST['pw'])<6){
    skip('login.php','error','密码不得少于6位');
}
if(strtolower($_SESSION['vcode'])!=strtolower($_POST['vcode'])){
    skip('register.php','error','验证码有误');
}

?>