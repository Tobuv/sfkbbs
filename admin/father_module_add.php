
<?php 
include_once '../inc/config.inc.php'; 
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
//var_dump($_POST);
if(isset($_POST['submit'])){
    $link=connect();    
    $_POST=escape($link,$_POST);
    $query_select="select * from skf_father_moudle where moudle_name='{$_POST['module_name']}'";
    $query="insert into skf_father_moudle(moudle_name,sort) values('{$_POST['module_name']}',{$_POST['sort']})";
    if(!isset($_POST['module_name'])||!isset($_POST['sort'])){
        skip('father_module_add.php','error','参数错误');
    }
    $result=execute($link,$query_select);
    if(mysqli_num_rows($result)){
        skip('father_module_add.php','error','该版块已存在');
    }
    execute($link,$query);
    if(mysqli_affected_rows($link)==1){
        skip('father_module.php','ok','恭喜你添加成功');
    }else{
        skip('father_module.php','error','删除失败');
    }

}
?>
<?php $title='添加父版块'; include 'inc/header.inc.php'?>
<div id="main">
<div class="title">添加父版块</div>
<form action="" method="POST">
    <table class="au">
    <tr>
        <td>版块名称</td>
        <td><input name="module_name" type="text" /></td>
        <td>
            支持HTML代码
        </td>
    </tr>
    <tr>
        <td>排序</td>
        <td><input name="sort" type="text" /></td>
        <td>
            支持HTML代码
        </td>
    </tr>

</table>
<input style="cursor: pointer" class="btn" type="submit" name="submit" value="添加" />
</form>

</div>
<?php include 'inc/footer.inc.php'?>