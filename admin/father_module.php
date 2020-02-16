<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
$link=connect();


?>
<?php $title='父版块列表';include 'inc/header.inc.php'?>
<div id="main" style="height:1000px;">
		<div class="title">功能说明</div>
		
		<table class="list">
			<tr>
				<th>排序</th>	 	 	
				<th>版块名称</th>
				<th>操作</th>
            </tr>
            <?php
            $query='select * from skf_father_moudle';
            $result=execute($link,$query);
            while($data=mysqli_fetch_assoc($result)){
                //"father_module_delete.php?id={$data['id']}"
                $url=urlencode("father_module_delete.php?id={$data['id']}");
                $return_url=urlencode($_SERVER['REQUEST_URI']);
                $delete_url="confirm.php?url={$url}&return_url={$return_url}";

$html=<<<STAR
            <tr>
                <td><input class="sort" type="text" name="sort" /></td>
                <td>{$data['moudle_name']}[id:{$data['id']}]</td>
                
                <td><a href="#">[访问]</a>&nbsp;&nbsp;<a href="father_module_update.php?id={$data['id']}">[编辑]</a>&nbsp;&nbsp;<a href={$delete_url}>[删除]</a></td>
            </tr>
STAR;
            echo $html;
            }
            ?>
			
		
		</table>
		<input class="btn" type="submit" name="submit" value="排序" />
		
	</div>

<?php include 'inc/footer.inc.php'?>