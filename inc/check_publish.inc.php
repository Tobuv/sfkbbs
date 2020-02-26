<?php
$_POST=escape($link,$_POST);
if(!isset($_POST['module_id'])||!is_numeric($_POST['module_id'])){
    skip('login.php','error','所属板块id不合法');
}
$query="select * from sfk_son_module where id={$_POST['module_id']}";
$result=execute($link,$query);
if(mysqli_num_rows($result)==0){
    skip('login.php','error','所属板块不存在呢');
}
if(strlen($_POST['title'])>255){
    skip('login.php','error','亲，标题不得超过255个字符');
}


?>