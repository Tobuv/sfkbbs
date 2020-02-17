<?php
//var_dump($_SERVER);
/* if(isset($_POST['submit'])){
    var_dump($_POST);
    exit(); */
include_once '../inc/config.inc.php'; 
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect(); 
if(isset($_POST['submit'])){
    //验证用户信息
    include 'inc/check_son_module.php';
    $query="insert into sfk_son_module(father_module_id,module_name,info,member_id,sort) values({$_POST['father_module_id']},'{$_POST['module_name']}','{$_POST['info']}',{$_POST['member_id']},{$_POST['sort']})";
    //echo $query;
    execute($link,$query);
    if(mysqli_affected_rows($link)==1){
        skip('son_module.php','ok',"恭喜你，添加成功");
    }
}
?>
<?php $title='添加子版块'; include 'inc/header.inc.php'?>
<div id="main">
<div class="title">添加子版块</div>
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
                while($data=mysqli_fetch_assoc($result_father)){
                    echo "<option value={$data['id']}>{$data['moudle_name']}</option>";
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
        <td><input name="module_name" type="text" /></td>
        <td>
            支持HTML代码
        </td>
    </tr>
    <tr>
        <td>版块简介</td>
        <td><textarea name="info" id="" cols="30" rows="10"></textarea></td>
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