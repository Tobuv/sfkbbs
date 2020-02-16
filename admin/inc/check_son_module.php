<?php
if(!is_numeric($_POST['father_module_id'])){
    skip('son_module_add.php','error',"所属父版块不得为空！");
}
$query="select * from skf_father_moudle where id={$_POST['father_module_id']}";
$result=execute($link,$query);
if(mysqli_num_rows($result)==0){
    skip('son_module_add.php','error',"所属父版块不存在！");
}
?>