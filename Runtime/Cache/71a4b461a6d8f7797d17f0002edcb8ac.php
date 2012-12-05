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
				
				<a href="loca.html" class="nav">
					<span class="nav_arrow"></span>
					<span class="nav_loca" alt="广告位"></span>
					<p>广告位</p>
				</a>

				<a class="nav n_on">
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
					<span id="loading_list" alt='0' gone='4' name='con_mat'></span>
					<div class="null_list">
						<span class="null_mat"></span>
						<span class="null_text">素材库是空的</span>
						<span class="null_ps">您可以现在添加一些素材，也可以在新增广告时直接添加</span>
						<a href="javascript:void(0)" onclick="also_filler(5,'main_mat','新增素材','main')" class="null_add">新增一个素材</a>
					</div>
					<div id='con_mat'>
						<div class="topic_mat">
							<h2>共有<span id="topic_mat_num1" class="topic_num1"></span>个素材</h2>
							<a href="javascript:void(0)" onclick="also_filler(5,'main_mat','新增素材','main')" class="add_mat">新增素材</a>
							<div class="filter_mat">
								<select id="sele_types">
									<option value="all">所有类型</option>
									<option value="1">图片</option>
									<option value="2">flash</option>
									<option value="3">代码</option>
									<option value="4">文字</option>
								</select>
								<input id="datas_size" type="hidden">
								<input id="size_now" type="hidden">
								<select id="sele_sizes">
									<option value="all">所有尺寸</option>
									<option value="1">468x60</option>
									<option value="2">666x90</option>
									<option value="3">777x80</option>
								</select>
								<input id="state_now" type="hidden">
							</div>
						</div>

						<div id="contBox" class="cont_mat">

							<div class="list_mat">
								<div class="size_mat">300x200</div>
								<div class="ops_mat">
									<a href="javascript:void(0)">编辑</a>
									<a href="javascript:void(0)">查看统计</a>
								</div>
								<div class="view_mat">
									<a href="javascript:void(0)" title="点击预览">
										<img src="http://adnets.cn/pics/b05.jpg" alt="">
									</a>
								</div>
								<div class="tit_mat">
									<p class="t1_mat">广告素材001</p>
									<p class="t2_mat">
										<span class="tp_mat">图片</span>
										<span>/</span>
										<span class="tm_mat">2012年12月2日上传</span>
									</p>
								</div>
							</div>

							<div class="list_mat">
								<div class="size_mat">无</div>
								<div class="ops_mat">
									<a href="javascript:void(0)">编辑</a>
									<a href="javascript:void(0)">查看统计</a>
								</div>
								<div class="view_mat">
									<a class="no_preview" href="javascript:void(0)" title="无预览">
										<img src="__PUBLIC__/img/code.png" alt="">
									</a>
								</div>
								<div class="tit_mat">
									<p class="t1_mat">广告素材002</p>
									<p class="t2_mat">
										<span class="tp_mat">代码</span>
										<span>/</span>
										<span class="tm_mat">2012年12月2日上传</span>
									</p>
								</div>
							</div>

							<div class="list_mat">
								<div class="size_mat">468x60</div>
								<div class="ops_mat">
									<a href="javascript:void(0)">编辑</a>
									<a href="javascript:void(0)">查看统计</a>
								</div>
								<div class="view_mat">
									<a href="javascript:void(0)" title="点击预览">
										<span class="forFlash"></span>
										<embed quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="transparent" src="http://adnets.cn/pics/5.swf" width="468" height="60">
									</a>
								</div>
								<div class="tit_mat">
									<p class="t1_mat">广告素材003</p>
									<p class="t2_mat">
										<span class="tp_mat">Flash</span>
										<span>/</span>
										<span class="tm_mat">2012年12月2日上传</span>
									</p>
								</div>
							</div>

							<div class="list_mat">
								<div class="size_mat">720x68</div>
								<div class="ops_mat">
									<a href="javascript:void(0)">编辑</a>
									<a href="javascript:void(0)">查看统计</a>
								</div>
								<div class="view_mat">
									<a href="javascript:void(0)" title="点击预览">
										<img src="http://adnets.cn/img/pb6.jpg" alt="">
									</a>
								</div>
								<div class="tit_mat">
									<p class="t1_mat">广告素材004</p>
									<p class="t2_mat">
										<span class="tp_mat">图片</span>
										<span>/</span>
										<span class="tm_mat">2012年12月2日上传</span>
									</p>
								</div>
							</div>

							<div class="list_mat">
								<div class="size_mat">300x150</div>
								<div class="ops_mat">
									<a href="javascript:void(0)">编辑</a>
									<a href="javascript:void(0)">查看统计</a>
								</div>
								<div class="view_mat">
									<a href="javascript:void(0)" title="点击预览">
										<img src="__PUBLIC__/img/words.png" alt="">
									</a>
								</div>
								<div class="tit_mat">
									<p class="t1_mat">广告素材004</p>
									<p class="t2_mat">
										<span class="tp_mat">文字</span>
										<span>/</span>
										<span class="tm_mat">2012年12月2日上传</span>
									</p>
								</div>
							</div>
						</div>
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
		<script type="text/javascript" src="__PUBLIC__/js/also.js"></script>
		<script type="text/javascript">
			//loading(0);
			//getAnum(1,'adseat/cnt','topic_loca_num1');
			//pageStation(1);

			// $('#sele_chan').bind('change',function(){
			// 	$('#chan_now').val($(this).val());
			// 	pageStation(1);
			// });

			// $('#sele_state').bind('change',function(){
			// 	$('#state_now').val($(this).val());
			// 	pageStation(1);
			// });
		</script>
	</body>
</html>