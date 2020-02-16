<?php
include_once '../inc/config.inc.php';

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<title>确认界面</title>
<meta name="keywords" content="后台界面" />
<meta name="description" content="后台界面" />
<link rel="stylesheet" type="text/css" href="style/remind.css" />
</head>
<body>
<div class="notice"><span class="pic ask"></span> 你确定要删除吗？ <a href="<?php echo $_GET['url']?>">确定</a> <a href="<?php echo $_GET['return_url']?>">取消</a> </div>
</body>
</html>