<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
$query="delete from skf_father_moudle where id={$_GET['id']}";
if(!isset($_GET['id'])||!is_numeric($_GET['id'])){
    skip('father_module.php','error','id参数错误');
}
execute($link,$query);
if(mysqli_affected_rows($link)==1){
    skip('father_module.php','ok','恭喜你删除成功');
}else{
    skip('father_module.php','error','对不起删除失败');
}


?>