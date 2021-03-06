<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>广告位 - Adnets</title>
		<link rel="stylesheet" href="__PUBLIC__/ad/img/favicon.ico">
		<link rel="stylesheet" href="__PUBLIC__/ad/css/also.css">
	</head>
	<body>
		<div class="menu">
			<div class="logo"><a href="#"><img src="__PUBLIC__/ad/img/logo.png" alt="Adnets 广告管理系统"></a></div>
			<div class="navbar">
				<a href="ads.html" class="nav">
					<span class="ad_on_num">6</span>
					<span class="nav_arrow"></span>
					<img src="__PUBLIC__/ad/img/m1.png" alt="广告">
					<p>广告</p>
				</a>

				<a class="nav n_on">
					<span class="nav_arrow"></span>
					<img src="__PUBLIC__/ad/img/m2.png" alt="广告">
					<p>广告位</p>
				</a>

				<a href="#" class="nav bline">
					<span class="nav_arrow"></span>
					<img src="__PUBLIC__/ad/img/m3.png" alt="广告">
					<p>素材库</p>
				</a>

				<a href="#" class="nav">
					<span class="nav_arrow"></span>
					<img src="__PUBLIC__/ad/img/m4.png" alt="广告">
					<p>客户和订单</p>
				</a>

				<a href="#" class="nav bline">
					<span class="nav_arrow"></span>
					<img src="__PUBLIC__/ad/img/m5.png" alt="广告">
					<p>数据统计</p>
				</a>

				<a href="#" class="nav bline">
					<span class="nav_arrow"></span>
					<img src="__PUBLIC__/ad/img/m6.png" alt="广告">
					<p>操作日志</p>
				</a>
			</div>

			<div class="footer">
				<p><a href="#">admin</a></p>
				<p><a href="#">账户设置</a></p>
				<p><a href="#">退出</a></p>
			</div>
		</div>
		<div class="main">
			<div class="board">
				<div class="main_loca" id="main_loca">
					<div class="topic_loca">
						<h2>有<span class="topic_loca_num1">12</span>个广告位，<span class="topic_loca_num2">6</span>个正在投放</h2>
						<a href="tita.html" class="timetable_loca">查看广告排期</a>
						<a href="javascript:void(0)" onclick="also_slider(1,'main_loca','新增广告位')" class="addLoca_loca">新增广告位</a>
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

					<div class="cont_loca">

						<div class="list_loca ing_loca">
							<div class="list_left_loca">
								<p class="list_tit_loca">首页banner1<span id="list_chan_loca" title="所属频道">(xxx1)</span></p>
								<p class="list_oth_loca">
									<span id="list_size_loca" title="尺寸">468x60</span>
									<span id="list_type_loca" title="形式">banner</span>
								</p>	
							</div>
							
							<div class="list_state_loca">
								<p>正在投放</p>
								<p id="list_snum_loca">3</p>
							</div>

							<div class="list_ops_loca">
								 <a href="#">编辑</a>
								 <a href="#">投放广告</a>
								 <a href="#">查看统计</a>
								 <a href="#">获取代码</a>
							</div>
						</div>

						<div class="list_loca ing_loca">
							<div class="list_left_loca">
								<p class="list_tit_loca">首页banner2<span id="list_chan_loca" title="所属频道">(sfdssss1)</span></p>
								<p class="list_oth_loca">
									<span id="list_type_loca" title="形式">crazy</span>
								</p>	
							</div>
							
							<div class="list_state_loca">
								<p>正在投放</p>
								<p id="list_snum_loca">1</p>
							</div>

							<div class="list_ops_loca">
								 <a href="#">编辑</a>
								 <a href="#">投放广告</a>
								 <a href="#">查看统计</a>
								 <a href="#">获取代码</a>
							</div>
						</div>

						<div class="list_loca non_loca">
							<div class="list_left_loca">
								<p class="list_tit_loca">首页banner1<span id="list_chan_loca" title="所属频道">(xxx1)</span></p>
								<p class="list_oth_loca">
									<span id="list_size_loca" title="尺寸">468x60</span>
									<span id="list_type_loca" title="形式">banner</span>
								</p>	
							</div>
							
							<div class="list_state_loca">
								<p id="list_snum_loca">空闲</p>
							</div>

							<div class="list_ops_loca">
								 <a href="#">编辑</a>
								 <a href="#">投放广告</a>
								 <a href="#">查看统计</a>
								 <a href="#">获取代码</a>
							</div>
						</div>

						<div class="list_loca pla_loca">
							<div class="list_left_loca">
								<p class="list_tit_loca">某某广告位<span id="list_chan_loca" title="所属频道">(某某频道)</span></p>
								<p class="list_oth_loca">
									<span id="list_size_loca" title="尺寸">260x300</span>
									<span id="list_type_loca" title="形式">浮动</span>
								</p>	
							</div>
							
							<div class="list_state_loca">
								<p id="list_snum_loca">计划</p>
							</div>

							<div class="list_ops_loca">
								 <a href="#">编辑</a>
								 <a href="#">投放广告</a>
								 <a href="#">查看统计</a>
								 <a href="#">获取代码</a>
							</div>
						</div>

						<div class="list_loca pla_loca">
							<div class="list_left_loca">
								<p class="list_tit_loca">某某广告位<span id="list_chan_loca" title="所属频道">(某某频道)</span></p>
								<p class="list_oth_loca">
									<span id="list_size_loca" title="尺寸">260x300</span>
									<span id="list_type_loca" title="形式">浮动</span>
								</p>	
							</div>
							
							<div class="list_state_loca">
								<p id="list_snum_loca">计划</p>
							</div>

							<div class="list_ops_loca">
								 <a href="#">编辑</a>
								 <a href="#">投放广告</a>
								 <a href="#">查看统计</a>
								 <a href="#">获取代码</a>
							</div>
						</div>

						<div class="list_loca pla_loca">
							<div class="list_left_loca">
								<p class="list_tit_loca">某某广告位<span id="list_chan_loca" title="所属频道">(某某频道)</span></p>
								<p class="list_oth_loca">
									<span id="list_size_loca" title="尺寸">260x300</span>
									<span id="list_type_loca" title="形式">浮动</span>
								</p>	
							</div>
							
							<div class="list_state_loca">
								<p id="list_snum_loca">计划</p>
							</div>

							<div class="list_ops_loca">
								 <a href="#">编辑</a>
								 <a href="#">投放广告</a>
								 <a href="#">查看统计</a>
								 <a href="#">获取代码</a>
							</div>
						</div>

						<div class="list_loca pla_loca">
							<div class="list_left_loca">
								<p class="list_tit_loca">某某广告位<span id="list_chan_loca" title="所属频道">(某某频道)</span></p>
								<p class="list_oth_loca">
									<span id="list_size_loca" title="尺寸">260x300</span>
									<span id="list_type_loca" title="形式">浮动</span>
								</p>	
							</div>
							
							<div class="list_state_loca">
								<p id="list_snum_loca">计划</p>
							</div>

							<div class="list_ops_loca">
								 <a href="#">编辑</a>
								 <a href="#">投放广告</a>
								 <a href="#">查看统计</a>
								 <a href="#">获取代码</a>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		

		<script type="text/javascript">
			  var URL = "__URL__/";
		      var APP = "__APP__/";
		</script>
		<script type="text/javascript" src="__PUBLIC__/ad/js/jquery.js"></script>
		<script type="text/javascript" src="__PUBLIC__/ad/js/also.js"></script>
	</body>
</html>