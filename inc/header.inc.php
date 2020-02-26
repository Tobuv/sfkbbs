<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<title><?php echo $template['title']?></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<?php
foreach ($template['css'] as $value) {
	echo "<link rel='stylesheet' type='text/css' href='{$value}'>";
}
?>

</head>
<body>
	<div class="header_wrap">
		<div id="header" class="auto">
			<div class="logo">bbs论坛</div>
			<div class="nav">
				<a class="hover">首页</a>

			</div>
			<div class="serarch">
				<form>
					<input class="keyword" type="text" name="keyword" placeholder="搜索其实很简单" />
					<input class="submit" type="submit" name="submit" value="" />
				</form>
			</div>
			<div class="login">
				<?php
				$str=
<<<A
				<a>登录</a>&nbsp;
				<a>注册</a>
A;
				if(is_login($link)){
					echo "欢迎您，{$_COOKIE['sfk']['name']}";
				}else{
					echo $str;
				}
				?>
				
			</div>
		</div>
	</div>
	<div style="margin-top:55px;"></div>