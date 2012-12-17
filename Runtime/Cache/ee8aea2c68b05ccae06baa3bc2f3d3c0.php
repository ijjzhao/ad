<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=1280">
		<title>广告 - Adnets</title>
		<link rel="shortcut icon" href="__PUBLIC__/img/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="__PUBLIC__/css/also.css" type="text/css">
		<link rel="stylesheet" href="__PUBLIC__/css/jquery.miniColors.css" type="text/css">
	</head>
	<body>
				<div class="menu">
			<div class="logo"><a href="#"><img src="__PUBLIC__/img/logo.png" alt="Adnets 广告管理系统"></a></div>
			<div class="navbar">
				<a href="<?php echo U('index/ad');?>" class="nav 
				<?php if(($m==ad)): ?>n_on<?php endif; ?>
				">
					<span class="nav_arrow"></span>
					<span class="nav_ad" alt="广告"></span>
					<p>广告</p>
				</a>
				
				<a href="<?php echo U('index/loca');?>" class="nav 
				<?php if(($m==loca)): ?>n_on<?php endif; ?>
				">
					<span class="nav_arrow"></span>
					<span class="nav_loca" alt="广告位"></span>
					<p>广告位</p>
				</a>

				<a href="<?php echo u('index/mater');?>" class="nav 
				<?php if(($m==mater)): ?>n_on<?php endif; ?>
				">
					<span class="nav_arrow"></span>
					<span class="nav_mat" alt="素材库"></span>
					<p>素材库</p>
				</a>
				<span class="bline" ></span>
				<a href="#" class="nav">
					<span class="nav_arrow"></span>
					<span class="nav_ord" alt="客户和订单"></span>
					<p>客户和订单</p>
				</a>

				<a href="#" class="nav">
					<span class="nav_arrow"></span>
					<span class="nav_data" alt="数据统计"></span>
					<p>数据统计</p>
				</a>
				<span class="bline" ></span>
				<a href="#" class="nav">
					<span class="ad_on_num">9</span>
					<span class="nav_arrow"></span>
					<span class="nav_info" alt="通知中心"></span>
					<p>通知中心</p>
				</a>
			</div>

			<div class="footer">
				<p><a href="#">admin</a></p>
				<p><a href="#">系统设置</a></p>
				<p><a href="#">退出</a></p>
			</div>
		</div>
		
	</body>
</html>