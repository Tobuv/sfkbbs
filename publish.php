<?php
include_once "inc/mysql.inc.php";
include_once "inc/tool.inc.php";
include_once "inc/config.inc.php";
$template['title']='发布帖子';
$template['css']=array('style/public.css','style/publish.css');
$link=connect();
if(!$member_id=is_login($link)){
    skip('login.php','error','您尚未登陆');
}
if(isset($_POST['submit'])){
    include_once "inc/check_publish.inc.php";
    $query="insert into sfk_content(module_id,title,content,time,member_id) values({$_POST['module_id']},'{$_POST['title']}','{$_POST['content']}',now(),{$member_id})";
    $result_content=execute($link,$query);
    if(mysqli_affected_rows($link)==1){
        skip('index.html','ok','发帖成功啦');
    }else{
        skip('index.html','error','发帖出错啦');
    }
}

?>

<?php include_once "inc/header.inc.php";?>
<div id="position" class="auto">
        <a>首页</a> &gt;<a>发帖</a>
</div>
<div id="publish">
    <form method="post">
        <select name="module_id">
            <?php
            $query_father="select * from skf_father_moudle";
            $result_father=execute($link,$query_father);
            while($data_father=mysqli_fetch_assoc($result_father)){
                echo "<optgroup label='{$data_father['moudle_name']}'>";
                $query_son="select * from sfk_son_module where father_module_id={$data_father['id']}";
                $result_son=execute($link,$query_son);
                while($data_son=mysqli_fetch_assoc($result_son)){
                    echo "<option value='{$data_son['id']}'>{$data_son['module_name']}</option>";
                }
                echo "</optgroup>";
            }
            ?>
      
        </select>
        <input class="title" placeholder="请输入标题" name="title" type="text" />
        <textarea name="content" class="content"></textarea>
        <input class="publish" type="submit" name="submit" value="" />
        <div style="clear:both;"></div>
    </form>
</div>
<?php include_once "inc/footer.inc.php";?>
