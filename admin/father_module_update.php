<?php 
include_once '../inc/config.inc.php'; 
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
//var_dump($_POST);
$link=connect(); 
if(!isset($_GET['id'])||!is_numeric($_GET['id'])){
    skip('father_module.php','error','参数错误');
}
$query_select="select * from skf_father_moudle where id={$_GET['id']}";
$result=execute($link,$query_select);
if(!mysqli_num_rows($result)){
    skip('father_module.php','error','没有该版块信息');
}
$data=mysqli_fetch_assoc($result);
if(isset($_POST['submit'])){
    
    $query="update skf_father_moudle set moudle_name='{$_POST['module_name']}',sort={$_POST['sort']} where id={$_GET['id']}"  ;
    execute($link,$query);
    if(mysqli_affected_rows($link)==1){
        skip('father_module.php','ok','修改成功');
    }
}
?>

<?php $title='编辑内容'; include 'inc/header.inc.php'?>
<div id="main">
<div class="title">修改父版块--<?php echo $data['moudle_name']?></div>
<form action="" method="POST">
    <table class="au">
    <tr>
        <td>版块名称</td>
        <td><input name="module_name" type="text" value="<?php echo $data['moudle_name']?>" /></td>
        <td>
            支持HTML代码
        </td>
    </tr>
    <tr>
        <td>排序</td>
        <td><input name="sort" type="text" value="<?php echo $data['sort']?>"/></td>
        <td>
            支持HTML代码
        </td>
    </tr>

</table>
<input style="cursor: pointer" class="btn" type="submit" name="submit" value="修改" />
</div>
<?php include 'inc/footer.inc.php'?>