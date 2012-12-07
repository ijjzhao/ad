<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=1280">
		<title>素材库 - Adnets</title>
	
		<link rel="shortcut icon" href="__PUBLIC__/img/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="__PUBLIC__/css/also.css" type="text/css">
</head>
	<body>
		<div class="menu">
			<div class="logo"><a href="#"><img src="__PUBLIC__/img/logo.png" alt="Adnets 广告管理系统"></a></div>
			<div class="navbar">
				<a href="#" class="nav">
					<span class="nav_arrow"></span>
					<span class="nav_ad" alt="广告"></span>
					<p>广告</p>
				</a>
				
				<a href="<?php echo U('index/index');?>" class="nav 
				<?php if(($m==loca)): ?>n_on<?php endif; ?>
				">
					<span class="nav_arrow"></span>
					<span class="nav_loca" alt="广告位"></span>
					<p>广告位</p>
				</a>

				<a href="<?php echo u('material/index');?>" class="nav 
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
		<div id="main">
			<div class="board">
				<div class="main_loca" id="main_loca">
					<span id="loading_list" alt='0' gone='4' name='con_loca'></span>
					<div class="null_list">
						<span class="null_loca"></span>
						<span class="null_text">还没有广告位</span>
						<a href="javascript:void(0)" onclick="also_filler(1,'main_loca','新增广告位','main')" class="null_add">添加一个广告位</a>
					</div>
					<div id='con_loca'>
						<div class="topic_loca">
							<h2>共有<span id="topic_num1" class="topic_loca_num1"></span>个广告位，<span id="topic_num2" class="topic_loca_num2">6</span>个正在投放</h2>
							<a href="tita.html" class="timetable_loca">查看广告排期</a>
							<a href="javascript:void(0)" onclick="also_filler(1,'main_loca','新增广告位','main')" class="addLoca_loca">新增广告位</a>
							<div class="filter_loca">
								<select id="sele_chan"></select>
								<input id="datas_chan" type="hidden">
								<input id="chan_now" type="hidden">
								<select id="sele_state">
									<option value="all">全部状态</option>
									<option value="1">正在投放</option>
									<option value="0">空闲</option>
									<option value="-1">计划</option>
								</select>
							</div>
						</div>

						<div id="contBox" class="cont_loca"></div>
						<span class="filter">没有符合条件的广告位</span>
						<div class="pages_box">
							<div id="loading_pgs"><span class="load_pgs"></span></div>
							<div id="pgs_box" class="pagination"></div>
						</div>
					</div>	
				</div>
			</div>
		</div>
		<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
		<script type="text/javascript" src="__PUBLIC__/js/poshytip.min.js"></script>
		<script type="text/javascript" src="__PUBLIC__/js/pagination.js"></script>
		<script type="text/javascript" src="__PUBLIC__/js/also.js"></script>
		<script type="text/javascript">

			$(document).ready(function(){
			  	loading(0);
			  	getAnum('adseat/cnt','topic_num1');
				getChan(2);
				pageStation(1);
				$('#sele_chan').bind('change',function(){
					$('#chan_now').val($(this).val());
					pageStation(1);
				});

				// $('#sele_state').bind('change',function(){
				// 	$('#state_now').val($(this).val());
				// 	pageStation(1);
				// });
			})
						
		</script>
	</body>
</html>