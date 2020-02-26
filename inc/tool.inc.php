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
function is_login($link){
    if(isset($_COOKIE['sfk']['name'])&&isset($_COOKIE['sfk']['pw'])){
        $query="select * from sfk_member where name='{$_COOKIE['sfk']['name']}' and pw='{$_COOKIE['sfk']['pw']}'";
        $result=execute($link,$query);
        $data=mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)==1){
            return $data['id'];
        }else{
            return false;
        }
    }else{
        return false;
    }
}
?>