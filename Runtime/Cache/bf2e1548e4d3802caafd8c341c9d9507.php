<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>广告位 - Adnets</title>
		<link rel="stylesheet" href="../Public/img/favicon.ico">
		<link rel="stylesheet" href="../Public/css/also.css">
	</head>
	<body>
		<div class="menu">
			<div class="logo"><a href="#"><img src="../Public/img/logo.png" alt="Adnets 广告管理系统"></a></div>
			<div class="navbar">
				<a href="ads.html" class="nav">
					<span class="nav_arrow"></span>
					<span class="nav_ad" alt="广告"></span>
					<p>广告</p>
				</a>
				
				<a class="nav n_on">
					<span class="nav_arrow"></span>
					<span class="nav_loca" alt="广告位"></span>
					<p>广告位</p>
				</a>

				<a href="#" class="nav">
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
		<div id="main">
			<div class="board">
				<div class="main_loca" id="main_loca">
					<div class="topic_loca">
						<h2>有<span class="topic_loca_num1">12</span>个广告位，<span class="topic_loca_num2">6</span>个正在投放</h2>
						<a href="tita.html" class="timetable_loca">查看广告排期</a>
						<a href="javascript:void(0)" onclick="also_slider(1,'main_loca','新增广告位','main')" class="addLoca_loca">新增广告位</a>
						<div class="filter_loca">
							<select id="sele_chan">
								<option value="0">全部频道</option>
								<option value="1">频道1</option>
								<option value="2">频道2</option>
							</select>
							<select id="sele_state">
								<option value="0">全部状态</option>
								<option value="1">正在投放</option>
								<option value="2">空闲</option>
								<option value="2">计划</option>
							</select>
						</div>
					</div>

					<div id="contBox" class="cont_loca"></div>
					<div class="pages_box">
						<div id="pgs_box" class="pagination"></div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="../Public/js/jquery.js"></script>
		<script type="text/javascript" src="../Public/js/also.js"></script>
		<script type="text/javascript" src="../Public/js/poshytip.min.js"></script>
		<script type="text/javascript" src="../Public/js/pagination.js"></script>
		<script type="text/javascript">
			

			pageStation(1);
			

		</script>
	</body>
</html>