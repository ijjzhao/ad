<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=1280">
		<title>广告 - Adnets</title>
		<link rel="shortcut icon" href="__PUBLIC__/img/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="__PUBLIC__/css/also.css" type="text/css">
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
		<body>
		<div class="main">
			<div class="board">
				<div class="main_ad">
					<div class="topic_ad">
						<h2>有<span class="topic_ad_num1">66</span>个广告正在投放，<span class="topic_ad_num2">33</span>个广告等待投放</h2>
						<a href="tita.html" class="timetable_ad">查看广告排期</a>
						<a href="#" class="addAd_ad">投放广告</a>
						<div class="filter_ad">
							<select id="sele_ads">
								<option value="0">所有广告</option>
								<option value="1">正在投放</option>
								<option value="2">等待投放</option>
								<option value="3">结束投放</option>
							</select>
						</div>
					</div>

					<div id="contBox" class="cont_ad">
						<div class="list_ad ing_ad">
							<div class="list_left_ad">
								<p class="list_tit_ad">移动秋季促销banner<a href="#" class="view_ad" title="查看素材" ></a></p>
								<p class="list_oth_ad"><span class="list_site_ad" title="广告位">首页banner</span><span class="list_chan_ad" title="频道">（频道1）</span><span class="list_order_ad" title="订单">/移动订单</span></p>	
							</div>
							
							<div class="list_time_ad">
								<p>开始：<span class="list_start_ad">2012-10-31</span></p>
								<p>结束：<span class="list_end_ad">2012-11-20</span></p>
							</div>

							<div class="list_ops_ad">
								<a href="#">编辑</a>
								<a href="#">暂停</a>
								<a href="#">查看统计</a>
							</div>
						</div>

						<div class="list_ad wait_ad">
							<div class="list_left_ad">
								<p class="list_tit_ad">移动秋季促销banner<a href="#" class="view_ad"></a></p>
								<p class="list_oth_ad"><span class="list_site_ad" title="广告位">首页banner</span><span class="list_chan_ad" title="频道">（频道1）</span><span class="list_order_ad" title="订单">/移动订单</span></p>
							</div>
							
							<div class="list_time_ad">
								<p>开始：<span class="list_start_ad">2012-10-31</span></p>
								<p>结束：<span class="list_end_ad">2012-11-20</span></p>
							</div>
							
							<div class="list_ops_ad">
								<a href="#">编辑</a>
								<a href="#">暂停</a>
								<a href="#">查看统计</a>
							</div>
						</div>

						<div class="list_ad end_ad">
							<div class="list_left_ad">
								<p class="list_tit_ad">移动秋季促销banner<a href="#" class="view_ad"></a></p>
								<p class="list_oth_ad"><span class="list_site_ad" title="广告位">首页banner</span><span class="list_chan_ad" title="频道">（频道1）</span><span class="list_order_ad" title="订单">/移动订单</span></p>
							</div>
							
							<div class="list_time_ad">
								<p>开始：<span class="list_start_ad">2012-10-31</span></p>
								<p>结束：<span class="list_end_ad">2012-11-20</span></p>
							</div>
							
							<div class="list_ops_ad">
								<a href="#">编辑</a>
								<a href="#">暂停</a>
								<a href="#">查看统计</a>
							</div>
						</div>

					</div>
					<span class="filter">没有符合条件的广告</span>
					<div class="pages_box">
						<div id="loading_pgs"><span class="load_pgs"></span></div>
						<div id="pgs_box" class="pagination"></div>
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
			  	//loading(0);
			  //	getAnum('adseat/cnt','topic_num1');
				
			//	pageStation(1);

				// $('#sele_chan').on('change',function(event){
				// 	$('#chan_now').val(event.target.value);
				// 	pageStation(1);
				// });

			})
						
		</script>
	</body>
	</body>
</html>