<?php
function skip($url,$pic,$message){
$html=<<<STAR
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<meta http-equiv="refresh" content="3;url={$url}">
<title>正在跳转中</title>
<link rel="stylesheet" type="text/css" href="style/remind.css" />
</head>
<body>
<div class="notice"><span class="pic {$pic}"></span>{$message} <a href="{$url}">立即跳转！</a></div>
</body>
</html>
STAR;
echo $html;
exit();
}
?>