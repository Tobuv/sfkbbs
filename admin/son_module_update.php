<?php 
include_once '../inc/config.inc.php'; 
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
//var_dump($_POST);
$link=connect(); 
if(!isset($_GET['id'])||!is_numeric($_GET['id'])){
    skip('son_module.php','error','参数错误');
}
$query_select="select * from sfk_son_module where id={$_GET['id']}";
$result=execute($link,$query_select);
if(!mysqli_num_rows($result)){
    skip('son_module.php','error','没有该版块信息');
}
$data=mysqli_fetch_assoc($result);
if(isset($_POST['submit'])){
/*     sfk_son_module(father_module_id,module_name,info,member_id,sort) values({$_POST['father_module_id']},'{$_POST['module_name']}','{$_POST['info']}',{$_POST['member_id']},{$_POST['sort']})"
 */    
    $query="update sfk_son_module set father_module_id={$_POST['father_module_id']},module_name='{$_POST['module_name']}',info='{$_POST['info']}',member_id={$_POST['member_id']},sort={$_POST['sort']} where id={$_GET['id']}"  ;
    execute($link,$query);
    if(mysqli_affected_rows($link)==1){
        skip('son_module.php','ok','修改成功');
    }
}
?>

<?php $title='编辑内容'; include 'inc/header.inc.php' ?>
<div id="main">
<div class="title">修改子版块--<?php echo $data['module_name']?></div>
<form action="" method="POST">
    <table class="au">
    <tr>
        <td>所属父版块</td>
        <td>
            <select name="father_module_id" id="">
                <option value="">请选择父版块</option>
                <?php
                $query='select * from skf_father_moudle';
                $result_father=execute($link,$query);
                while($data_father=mysqli_fetch_assoc($result_father)){
                    if($data_father['id']==$data['father_module_id']){
                        echo "<option selected='select' value={$data_father['id']}>{$data_father['moudle_name']}</option>";
                    }else{
                        echo "<option value={$data_father['id']}>{$data_father['moudle_name']}</option>";
                    }
                    
                }
                ?>
            </select>
        </td>
        <td>
            支持HTML代码
        </td>
    </tr>
    <tr>
        <td>版块名称</td>
        <td><input name="module_name" type="text" value="<?php echo $data['module_name']?>" /></td>
        <td>
            支持HTML代码xxx
        </td>
    </tr>
    <tr>
        <td>版块简介</td>
        <td><textarea name="info" cols="30" rows="10"><?php echo $data['info']?></textarea></td>
        <td>
            支持HTML代码
        </td>
    </tr>
    <tr>
        <td>版主</td>
        <td>
            <select name="member_id" id="">
                <option value="0">请选择一个版主</option>
            </select>
        </td>
        <td>
            支持HTML代码
        </td>
    </tr>
    <tr>
        <td>排序</td>
        <td><input name="sort" value="<?php echo $data['sort']?>" type="text" /></td>
        <td>
            支持HTML代码
        </td>
    </tr>
</table>
<input style="cursor: pointer" class="btn" type="submit" name="submit" value="修改" />
</form>
</div>
<?php include 'inc/footer.inc.php'?>
