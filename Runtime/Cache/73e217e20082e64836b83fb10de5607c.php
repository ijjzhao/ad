<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=1280">
		<title>素材库 - Adnets</title>
		<link rel="shortcut icon" href="__PUBLIC__/img/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="__PUBLIC__/css/also.css" type="text/css">
		<link rel="stylesheet" href="__PUBLIC__/css/jquery.miniColors.css" type="text/css">
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
				<div class="main_mat" id="main_mat">
					<span id="loading_list" alt='0' gone='3' name='con_mat'></span>
					<div class="null_list">
						<span class="null_mat"></span>
						<span class="null_text">素材库是空的</span>
						<span class="null_ps">您可以现在添加一些素材，也可以在新增广告时直接添加</span>
						<a href="javascript:void(0)" onclick="also_slider(5,'also_slider_mat','main_mat','新增素材','main')" class="null_add">新增一个素材</a>
					</div>
					<div id='con_mat'>
						<div class="topic_mat">
							<h2>共有<span id="topic_num1" class="topic_mat_num1"></span>个素材</h2>
							<a href="javascript:void(0)" onclick="also_slider(5,'also_slider_mat','main_mat','新增素材','main')" class="add_mat">新增素材</a>
							<div class="filter_mat">
								<select id="sele_types">
									<option value="all">所有类型</option>
									<option value="p">图片</option>
									<option value="f">flash</option>
									<option value="w">代码</option>
									<option value="s">文字</option>
								</select>
								<input id="datas_size" type="hidden">
								<input id="size_now" type="hidden">
								<select id="sele_sizes"></select>
							</div>
						</div>
						<div id="contBox" class="cont_mat"></div>
						<span class="filter">没有符合条件的素材</span>
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
		<script type="text/javascript" src="__PUBLIC__/js/miniColors.js"></script>
		<script type="text/javascript" src="__PUBLIC__/js/ajaxupload.js"></script>
		<script type="text/javascript" src="__PUBLIC__/js/also.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			loading(0);
			getAnum('material/cnt','topic_num1');
			getMatSize();
			pageStation(3);
			
			$('#sele_types').on('change',function(){
				pageStation(3);
			});
			
			$('#sele_sizes').on('change',function(event){
				$('#size_now').val(event.target.value);
				pageStation(3);
			});
		});
		</script>
	</body>
</html>