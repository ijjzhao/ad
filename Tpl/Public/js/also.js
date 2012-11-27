/*
	url
*/
function also_url(){
	return 'http://localhost/ad/';
}
/*	
	 滑层
	 sid：slider的id
	 dad：父层id
	 tit：标题
	 locker：用于锁定/解开父层的纵向滚动条
	 fill：填充的内容
*/
function also_slider(sid,dad,tit,locker,fill){
	var num=$('.also_slider').size()+1;
	var sli={
		zin:num*100,
		left:78+(num*36),
		lzin:num*90
	}
	var d ='<div id="'+sid+'_lock" class="also_locker" onclick="also_remove(\''+sid+'\',\''+locker+'\')" title="点击关闭【'+tit+'】" style="z-index:'+sli.lzin+';" ></div>';
		d+='<div id="'+sid+'" style="z-index:'+sli.zin+';" class="also_slider"><a class="also_close" href="javascript:void(0)" onclick="also_remove(\''+sid+'\',\''+locker+'\')" alt="关闭【'+tit+'】" title="关闭【'+tit+'】"></a>'+fill+'</div>';

	$('#'+dad).append(d);
	$('#'+sid).animate({
		marginLeft:sli.left,
		width:'100%',
		opacity:'1'
	},350);
	$('#'+locker).css('overflow-y','hidden');
}

/*	
	 删除滑层
	 id：slider的id
	 locker：locker的id
*/
function also_remove(id,locker){
	$('#'+id).animate({
		opacity:0,
		marginLeft: 1174,
		width:0
	},350,function(){
		$('#'+id+'_lock').remove();
		$('#'+id).remove();
	});
	$('#'+locker).css('overflow-y','auto');
}

/*	 
	 滑层内容集中营
	 typ：类型
	 fid：父层id
	 tit：标题
	 locker：用于锁定/解开父层的纵向滚动条
	 eid：编辑时数据的id（数据库中的id）
*/
function also_filler(typ,fid,tit,locker,eid){
	var codes='',sid='';
	switch(typ){
		case 0:
			codes=0;
			break;
		case 1:
			//新增广告位
			sid='also_slider_locaf';

			codes=formBulder(1,tit,locker);
			var siz='<option value="">请选择</option>';
				siz+='<option value="" disabled="disabled">-----</option>';
				siz+='<option value="960x90">960x90</option>';
				siz+='<option value="960x60">960x60</option>';
				siz+='<option value="760x90">760x90</option>';
				siz+='<option value="728x90">728x90</option>';
				siz+='<option value="640x60">640x60</option>';
				siz+='<option value="580x90">580x90</option>';
				siz+='<option value="500x200">500x200</option>';
				siz+='<option value="480x160">480x160</option>';
				siz+='<option value="468x60">468x60</option>';
				siz+='<option value="460x60">460x60</option>';
				siz+='<option value="360x300">360x300</option>';
				siz+='<option value="300x250">300x250</option>';
				siz+='<option value="250x250">250x250</option>';
				siz+='<option value="234x60">234x60</option>';
				siz+='<option value="200x200">200x200</option>';
				siz+='<option value="180x150">180x150</option>';
				siz+='<option value="160x600">160x600</option>';
				siz+='<option value="125x125">125x125</option>';
				siz+='<option value="120x600">120x600</option>';
				siz+='<option value="120x240">120x240</option>';

		
			break;
		case 2:
			//编辑广告位
			sid='also_slider_locaf';
			codes=formBulder(1,tit,locker,eid);

			break;
		case 3:
			//新增频道
			sid='also_slider_addCh';
			codes=formBulder(2,tit,locker);			
			break;
		case 4:
			//编辑频道
			break;
		case 5:
			//新增素材
			break;
		case 6:
			//编辑素材
			break;
		case 7:
			//新增广告
			sid='also_slider_addAd';
			codes='<div class="addAd">';
			codes+='<p>'+tit+'</p>';
			codes+='</div>';
			break;
		case 8:
			//编辑广告
			break;
		case 9:
			//获取投放代码
			sid='also_slider_alsoKey';
			codes='<div class="alsoKey">';
			codes+='<p class="topic_key">'+tit+'的广告代码</p>';
			codes+='<div id="swi2_key" style="background:#ECF6EB;" class="swi_key">';
			codes+='<div class="swi_L_key"><input type="radio" id="swi2" checked="true" name="swis_key"></div>';
			codes+='<label for="swi2">';
			codes+='<p class="h_key">使用2段式代码</p>';
			codes+='<p class="c_key">最佳投放方案，适合熟悉html的用户</p>';
			codes+='</lable>';
			codes+='</div>';
			codes+='<div id="swi1_key" class="swi_key">';
			codes+='<div class="swi_L_key"><input type="radio" id="swi1" name="swis_key"></div>';
			codes+='<label for="swi1">';
			codes+='<p class="h_key">使用1段式代码</p>';
			codes+='<p class="c_key">添加方便，性能不如2段式代码</p>';
			codes+='</lable>';
			codes+='</div>';
			codes+='<textarea id="key_key">';
			codes+='<!-- <head>代码，每个页面只需投放一次 -->\r';
			codes+='<script src="http://adnet.alsogood.com/js/AlsoAD.js"></script>\r\r';
			codes+='<!-- <body>代码，投放至广告位:'+tit+' -->\r';
			codes+='<script type="text/javascript">adnet("'+eid+'");</script>';
			codes+='</textarea>';
			codes+='<p class="ps_key">复制广告代码粘贴到广告位所在位置即可，如需帮助，请联系客服（联系方式）';
			codes+='</div>';
			$('input[name="swis_key"]').live('click',function(){
				var id=$(this).attr('id'),keys='';
				$('.swi_key').css('background','#fff');
				$('#'+id+'_key').css('background','#ECF6EB');
				if(id=='swi1'){
					keys='<!-- 广告位:'+tit+' -->\r';
					keys+='<script type="text/javascript">also_mid="'+eid+'";</script>\r';
					keys+='<script src="http://adnet.alsogood.com/js/AlsoGoodAD.js"></script>';
				}else if(id=='swi2'){
					keys='<!-- <head>代码，每个页面只需投放一次 -->\r';
					keys+='<script src="http://adnet.alsogood.com/js/AlsoAD.js"></script>\r\r';
					keys+='<!-- <body>代码，投放至广告位:'+tit+' -->\r';
					keys+='<script type="text/javascript">adnet("'+eid+'");</script>';
				}
				$('#key_key').text(keys);
			});
			break;
		default:
			codes="oops";
	}

	also_slider(sid,fid,tit,locker,codes);
}


/*
	表单生成者
	typ：1=广告位（新增/编辑）2=频道
	tit
	locker
	eid：编辑项的id
*/
function formBulder(typ,tit,locker,eid){
	var codes='';
	switch(typ){
		case 1:
			var siz='<option value="">请选择</option>';
				siz+='<option value="" disabled="disabled">-----</option>';
				siz+='<option value="960x90">960x90</option>';
				siz+='<option value="960x60">960x60</option>';
				siz+='<option value="760x90">760x90</option>';
				siz+='<option value="728x90">728x90</option>';
				siz+='<option value="640x60">640x60</option>';
				siz+='<option value="580x90">580x90</option>';
				siz+='<option value="500x200">500x200</option>';
				siz+='<option value="480x160">480x160</option>';
				siz+='<option value="468x60">468x60</option>';
				siz+='<option value="460x60">460x60</option>';
				siz+='<option value="360x300">360x300</option>';
				siz+='<option value="300x250">300x250</option>';
				siz+='<option value="250x250">250x250</option>';
				siz+='<option value="234x60">234x60</option>';
				siz+='<option value="200x200">200x200</option>';
				siz+='<option value="180x150">180x150</option>';
				siz+='<option value="160x600">160x600</option>';
				siz+='<option value="125x125">125x125</option>';
				siz+='<option value="120x600">120x600</option>';
				siz+='<option value="120x240">120x240</option>';
			codes='<div class="locaf"><form id="form_locaf">';
			codes+='<p class="topic_locaf">'+tit+'</p>';
			codes+='<div class="board_locaf"><p class="tit_locaf">基本信息</p>';
			codes+='<p class="cont_locaf"><input id="name_locaf" name="ana" type="text" value="广告位名称"></p>';
			codes+='<p class="cont_locaf"><input id="remark_locaf" name="des" type="text" value="备注" ></p>';
			codes+='<p class="cont_locaf">';
			codes+='<select id="chan_locaf" name="chn" onchange="if(this.value==\'add\'){also_filler(3,\'also_slider_locaf\',\'新建频道\',\'also_slider_locaf\');$(this).val(\'0\')}">';
			codes+='</select>';
			codes+='</p>';
			codes+='</div>';
			codes+='<div class="board_locaf"><p class="tit_locaf"><span id="tt_locaf">广告位形式</span></p>';
			codes+='<p class="tts_locaf"><span><input name="spe" id="t1_locaf" value="1" title="固定" type="radio"><label for="t1_locaf">固定</label></span>';
			codes+='<span><input name="spe" id="t2_locaf" value="2" title="漂浮" type="radio"><label for="t2_locaf">漂浮</label></span>';
			codes+='<span><input name="spe" id="t3_locaf" value="3" title="Crazy" type="radio"><label for="t3_locaf">Crazy</label><a id="cra_tips" class="also_helper" href="javascript:void(0)">?</a></span>';
			codes+='<span><input name="spe" id="t4_locaf" value="4" title="PIP扩展" type="radio"><label for="t4_locaf">PIP扩展</label><a id="pip_tips" class="also_helper" href="javascript:void(0)">?</a></span>';
			codes+='</p>';
			codes+='<div id="base_locaf">';
			codes+='<p class="tit2_locaf">请设置<span id="tsp_locaf">固定</span>广告位的尺寸</p>'
			codes+='<div id="sp1_locaf" class="sp_locaf">';
			codes+='<p class="sis_locaf"><select id="size1_locaf" name="size_locaf">'+siz;
			codes+='</select><span id="diy1_locaf"><input id="width1_locaf" type="text" class="intex_locaf" value="宽">&nbsp;x&nbsp;<input id="height1_locaf" type="text" class="intex_locaf" value="高">&nbsp;(px)</span><a id="t_size1_locaf" alt="0" href="javascript:void(0)" onclick="sizeType(this.id,\'size1_locaf\',\'diy1_locaf\')">自定义尺寸</a></p>';
			codes+='</div>';
			codes+='<div id="sp2_locaf" class="sp_locaf">';
			codes+='<p class="tit2_locaf"><span id="screenPo_locaf">屏幕位置</span></p>';
			codes+='<p class="sis_locaf"><select id="gty_locaf" name="gty" onchange="setScrLoca(this.value,\'middle\',\'ver_locaf\')"><option value="top">居上</option><option value="middle">居中</option><option value="bottom">居下</option></select>';
			codes+='<span class="borp_locaf">边距：<input id="ver_locaf" name="ver" type="text" value="0">(px)</span></p>';
			codes+='<p class="sis_locaf"><select id="ore_locaf" name="ore" onchange="setScrLoca(this.value,\'center\',\'hor_locaf\')"><option value="left">居左</option><option value="center">居中</option><option value="right">居右</option></select>';
			codes+='<span class="borp_locaf">边距：<input id="hor_locaf" name="hor" type="text" value="0">(px)</span></p>';
			codes+='<p class="tit2_locaf">停留时间</p>';
			codes+='<p class="sis_locaf"><span id="stp1_locaf">[不限]</span><span id="stp2_locaf"><input id="stp_locaf" name="stp" value="-1" type="text">(秒)</span><a id="btn_stp_locaf" href="javascript:void(0)" onclick="">更改</a></p>';
			codes+='<p class="tit2_locaf"><input id="sll_locaf" name="sll" type="checkbox"><label for="sll_locaf">跟随滚动条</label><a>?</a></p>';
			codes+='</div>';
			codes+='<div id="sp3_locaf" class="sp_locaf">';
			codes+='<p class="sis_locaf">主画面：<select id="size2_locaf" name="size_locaf">'+siz;
			codes+='</select><span id="diy2_locaf"><input id="width2_locaf" type="text" class="intex_locaf" value="宽">&nbsp;x&nbsp;<input id="height2_locaf" type="text" class="intex_locaf" value="高">&nbsp;(px)</span><a id="t_size2_locaf" alt="0" href="javascript:void(0)" onclick="sizeType(this.id,\'size2_locaf\',\'diy2_locaf\')">自定义尺寸</a></p>';
			codes+='<p class="sis_locaf">副画面：<select id="size3_locaf" name="size_locaf">'+siz;
			codes+='</select><span id="diy3_locaf"><input id="width3_locaf" type="text" class="intex_locaf" value="宽">&nbsp;x&nbsp;<input id="height3_locaf" type="text" class="intex_locaf" value="高">&nbsp;(px)</span><a id="t_size3_locaf" alt="0" href="javascript:void(0)" onclick="sizeType(this.id,\'size3_locaf\',\'diy3_locaf\')">自定义尺寸</a></p>';
			codes+='</div>';
			codes+='</div>';
			codes+='</div>';
			codes+='<div class="board_locaf"><p class="tru_locaf"><input id="trust_locaf" name="psh" type="checkbox"><label for="trust_locaf">接受锦途推送的广告</label></p>';
			codes+='<p class="tru1_locaf">	勾选此项则我们会根据您的网站类型推荐广告给您，您可以选择接受或者不投放</p>';
			codes+='</div>';
			codes+='<div class="btns_locaf">';
			codes+='<a id="save_locaf" sli="also_slider_locaf" loc="'+locker+'"  class="save_locaf_1" >保存广告位</a>';
			codes+='<a id="cancel_locaf" href="javascript:void(0)" onclick="also_remove(\'also_slider_locaf\',\''+locker+'\')">取消</a>';
			codes+='</div>';
			codes+='<input type="hidden" name="pri"><input type="hidden" name="aux">';
			if(tit=='新增广告位'){
				codes+='</form></div>';
				codes+='<iframe onload="afterLoad(1)"></iframe>';
			}else{
				codes+='<input id="sta_locaf" type="hidden" name="sta" value="no">';
				codes+='<input id="eid_locaf" type="hidden" name="id" value="'+eid+'">';
				codes+='</form></div>';
				codes+='<iframe onload="afterLoad(3,\''+eid+'\')"></iframe>';
			}
			
			break;
		case 2:
			codes='<div class="chanf">';
			codes+='<form id="form_chanf">';
			codes+='<p class="topic_chanf">'+tit+'</p>';
			codes+='<div class="board_chanf">';
			codes+='<p class="cont_chanf"><input id="name_chanf" name="cna" type="text" value="频道名称"></p>';
			codes+='<p class="cont_chanf"><input id="remark_chanf" name="ces" type="text" value="备注"></p>';
			codes+='</div>';
			codes+='<div class="btns_chanf">';
			codes+='<a id="save_chanf" sli="also_slider_addCh" loc="'+locker+'"  class="save_chanf_1" >保存频道</a>';
			codes+='<a id="cancel_chanf" href="javascript:void(0)" onclick="also_remove(\'also_slider_addCh\',\''+locker+'\')">取消</a>';
			codes+='</div>';
			codes+='</form>';
			codes+='</div>';
			codes+='<iframe onload="afterLoad(2)"></iframe>';

			break;
	}
	return codes;
}

/*
	滑层数据append后调用的函数
	typ：1=广告位 2=新增频道 3=编辑广告位
	eid：编辑项的id
*/
function afterLoad(typ,eid){
	switch(typ){
		case 1:
			$('#t1_locaf').attr('checked',true);
			$('#sp1_locaf').css('display','block');

			$('input[name="spe"]').bind('click',function(){
				var va=parseInt($(this).val()),name=$(this).attr('title'),co='';
				co='<p class="tit2_locaf">请设置'+name+'广告位的尺寸</p>';
				if(va==1){
					$('.sp_locaf').css('display','none');
					$('#sp1_locaf').css('display','block');
					$('#tsp_locaf').text('固定');

				}else if(va==2){
					$('.sp_locaf').css('display','none');
					$('#sp1_locaf').css('display','block');
					$('#sp2_locaf').css('display','block');
					$('#tsp_locaf').text('漂浮');
				}else if(2<va<=4){
					$('.sp_locaf').css('display','none');
					$('#sp3_locaf').css('display','block');
					if(va==3){
						$('#tsp_locaf').text('Crazy');
					}else if(va==4){
						$('#tsp_locaf').text('PIP扩展');
					}	
				}
			});
			
			$('.board_locaf input[type="text"]').css('color','#999');
			$('#ver_locaf').css('color','#333');
			$('#hor_locaf').css('color','#333');
			$('#stp_locaf').css('color','#333');

			$('#name_locaf').bind('focus',function(){
				textholder(0,'name_locaf','广告位名称',$(this).val());
			});

			$('#name_locaf').bind('blur',function(){
				textholder(1,'name_locaf','广告位名称',$(this).val());
			});

			$('#remark_locaf').bind('focus',function(){
				textholder(0,'remark_locaf','备注',$(this).val());
			});

			$('#remark_locaf').bind('blur',function(){
				textholder(1,'remark_locaf','备注',$(this).val());
			});

			$('#save_locaf').bind('click',function(){
				sub_locaf(1);
			});

			$('#btn_stp_locaf').bind('click',function(){
				var val=$('#stp_locaf').val();
				if(val=='-1'){
					$('#stp1_locaf').fadeOut('fast',function(){
						$('#stp2_locaf').fadeIn('fast');
						$('#btn_stp_locaf').text('不限');
						$('#stp_locaf').val('30');
					});
				}else{
					$('#stp2_locaf').fadeOut('fast',function(){
						$('#stp1_locaf').fadeIn('fast');
						$('#btn_stp_locaf').text('更改');
						$('#stp_locaf').val('-1');
					});
				}
			});

			$('#width1_locaf').bind('focus',function(){
				textholder(0,'width1_locaf','宽',$(this).val());
			});

			$('#width1_locaf').bind('blur',function(){
				textholder(1,'width1_locaf','宽',$(this).val());
			});

			$('#height1_locaf').bind('focus',function(){
				textholder(0,'height1_locaf','高',$(this).val());
			});

			$('#height1_locaf').bind('blur',function(){
				textholder(1,'height1_locaf','高',$(this).val());
			});

			$('#width2_locaf').bind('focus',function(){
				textholder(0,'width2_locaf','宽',$(this).val());
			});

			$('#width2_locaf').bind('blur',function(){
				textholder(1,'width2_locaf','宽',$(this).val());
			});

			$('#height2_locaf').bind('focus',function(){
				textholder(0,'height2_locaf','高',$(this).val());
			});

			$('#height2_locaf').bind('blur',function(){
				textholder(1,'height2_locaf','高',$(this).val());
			});

			$('#width3_locaf').bind('focus',function(){
				textholder(0,'width3_locaf','宽',$(this).val());
			});

			$('#width3_locaf').bind('blur',function(){
				textholder(1,'width3_locaf','宽',$(this).val());
			});

			$('#height3_locaf').bind('focus',function(){
				textholder(0,'height3_locaf','高',$(this).val());
			});

			$('#height3_locaf').bind('blur',function(){
				textholder(1,'height3_locaf','高',$(this).val());
			});

			bubble(1); 
			getChan(1);

			break;
		case 2:
			$('.cont_chanf input[type="text"]').css('color','#999');
			$('#name_chanf').bind('focus',function(){
				textholder(0,'name_chanf','频道名称',$(this).val());
			});

			$('#name_chanf').bind('blur',function(){
				textholder(1,'name_chanf','频道名称',$(this).val());
			});

			$('#remark_chanf').bind('focus',function(){
				textholder(0,'remark_chanf','备注',$(this).val());
			});

			$('#remark_chanf').bind('blur',function(){
				textholder(1,'remark_chanf','备注',$(this).val());
			});

			$('#save_chanf').bind('click',function(){
				sub_chanf();
			});
			break;
		case 3:
			$('#name_locaf').bind('focus',function(){
				textholder(0,'name_locaf','广告位名称',$(this).val());
			});

			$('#name_locaf').bind('blur',function(){
				textholder(1,'name_locaf','广告位名称',$(this).val());
			});

			$('#remark_locaf').bind('focus',function(){
				textholder(0,'remark_locaf','备注',$(this).val());
			});

			$('#remark_locaf').bind('blur',function(){
				textholder(1,'remark_locaf','备注',$(this).val());
			});
			
			$('#save_locaf').bind('click',function(){
				sub_locaf(2);
			});

			var del='<a id="dele_locaf" sli="also_slider_locaf" loc="main" alt="1">删除</a>';
			$('#cancel_locaf').after(del);
			$('#dele_locaf').bind('click',function(){
				deleCenter($(this).attr('alt'),'dele_locaf','adseat/del/',eid);
			});

			bubble(1); // 气泡通知框
			getChan(1);// 获取频道数据

			$.ajax({
		         url:also_url()+'adseat/inf/'+eid,
		         type:"get",
		         beforeSend:function(){
		         		//loading
		           	},
		         success:function(d){
		         		var rs=eval('('+d+')');
		         		if(rs.status==1){
		         		var da=rs.data,
		         			desc=da.desc?da.desc:'备注',
		         			chan=(da.chnName=='0')?'all':da.chnName,
		         			shap=da.shape;
		         			if(shap=='1'){
		         				$('#sp1_locaf').css('display','block');

								var co='<option value="'+da.priSize[0]+'x'+da.priSize[1]+'">'+da.priSize[0]+'x'+da.priSize[1]+'</option>';

		         				$('#width1_locaf').val(da.priSize[0]);
		         				$('#height1_locaf').val(da.priSize[1]);
		         				$('#size1_locaf').append(co);
		         				$('#size1_locaf').val(da.priSize[0]+'x'+da.priSize[1]);
							
		         			}else if(shap=='2'){
		         				$('#sp2_locaf').css('display','block');
		         				$('#tsp_locaf').text('漂浮');
		         				var co='<option value="'+da.priSize[0]+'x'+da.priSize[1]+'">'+da.priSize[0]+'x'+da.priSize[1]+'</option>';

		         				$('#width1_locaf').val(da.priSize[0]);
		         				$('#height1_locaf').val(da.priSize[1]);
		         				$('#size1_locaf').append(co);
		         				$('#size1_locaf').val(da.priSize[0]+'x'+da.priSize[1]);

		         				if(da.isScroll=='on'){
									$('#sll_locaf').attr('checked',true);
								}
								if(da.reTime!='-1'){
									$('#stp1_locaf').fadeOut('fast',function(){
										$('#stp2_locaf').fadeIn('fast');
										$('#btn_stp_locaf').text('不限');
										$('#stp_locaf').val(da.reTime);
									});
								}

								$('#gty_locaf').val(da.layout.gavity);
								$('#ver_locaf').val(da.layout.vertical);
								$('#ore_locaf').val(da.layout.orientation);
								$('#hor_locaf').val(da.layout.horizontal);

		         			}else if(shap=='3' || shap=='4'){
		         				$('#sp3_locaf').css('display','block');

		         				if(shap=='3'){
									$('#tsp_locaf').text('Crazy');
		         				}else if(shap=='4'){
		         					$('#tsp_locaf').text('PIP扩展');
		         				}
		         				var co1='<option value="'+da.priSize[0]+'x'+da.priSize[1]+'">'+da.priSize[0]+'x'+da.priSize[1]+'</option>';
		         				var co2='<option value="'+da.auxSize[0]+'x'+da.auxSize[1]+'">'+da.auxSize[0]+'x'+da.auxSize[1]+'</option>';

		         				$('#width2_locaf').val(da.priSize[0]);
		         				$('#height2_locaf').val(da.priSize[1]);
		         				$('#width3_locaf').val(da.auxSize[0]);
		         				$('#height3_locaf').val(da.auxSize[1]);
		         				$('#size2_locaf').append(co1);
		         				$('#size3_locaf').append(co2);
		         				$('#size2_locaf').val(da.priSize[0]+'x'+da.priSize[1]);
								$('#size3_locaf').val(da.auxSize[0]+'x'+da.auxSize[1]);
	
		         			}
		        
		         		$('#name_locaf').val(rs.data.name);
		         		$('#remark_locaf').val(desc);
		         		if(desc=='备注'){
		         			$('#remark_locaf').css('color','#999');
		         		}
		         		$('#chan_locaf').val(chan);
		         		$('#t'+shap+'_locaf').attr('checked',true);

		         		if(da.isPush=='on'){
							$('#trust_locaf').attr('checked',true);	
						}

						$('input[name="spe"]').bind('click',function(){
							if($(this).val()==shap){
								$('#sta_locaf').val('no');
								tips('tt_locaf');
							}else{
								$('#sta_locaf').val('yes');
								tips('tt_locaf','修改广告位形式后，系统将暂停该广告位下的所有广告，您需要到“编辑广告”中重新设置方能启用');
							}
							var va=parseInt($(this).val()),name=$(this).attr('title'),co='';
							co='<p class="tit2_locaf">请设置'+name+'广告位的尺寸</p>';
							if(va==1){
								$('.sp_locaf').css('display','none');
								$('#sp1_locaf').css('display','block');
								$('#tsp_locaf').text('固定');

							}else if(va==2){
								$('.sp_locaf').css('display','none');
								$('#sp1_locaf').css('display','block');
								$('#sp2_locaf').css('display','block');
								$('#tsp_locaf').text('漂浮');
							}else if(2<va<=4){
								$('.sp_locaf').css('display','none');
								$('#sp3_locaf').css('display','block');
								if(va==3){
									$('#tsp_locaf').text('Crazy');
								}else if(va==4){
									$('#tsp_locaf').text('PIP扩展');
								}	
							}
						});

						$('#btn_stp_locaf').bind('click',function(){
							var val=$('#stp_locaf').val();
							if(val=='-1'){
								$('#stp1_locaf').fadeOut('fast',function(){
									$('#stp2_locaf').fadeIn('fast');
									$('#btn_stp_locaf').text('不限');
									$('#stp_locaf').val('30');
								});
							}else{
								$('#stp2_locaf').fadeOut('fast',function(){
									$('#stp1_locaf').fadeIn('fast');
									$('#btn_stp_locaf').text('更改');
									$('#stp_locaf').val('-1');
								});
							}
						});

						$('#width1_locaf').bind('focus',function(){
							textholder(0,'width1_locaf','宽',$(this).val());
						});

						$('#width1_locaf').bind('blur',function(){
							textholder(1,'width1_locaf','宽',$(this).val());
						});

						$('#height1_locaf').bind('focus',function(){
							textholder(0,'height1_locaf','高',$(this).val());
						});

						$('#height1_locaf').bind('blur',function(){
							textholder(1,'height1_locaf','高',$(this).val());
						});

						$('#width2_locaf').bind('focus',function(){
							textholder(0,'width2_locaf','宽',$(this).val());
						});

						$('#width2_locaf').bind('blur',function(){
							textholder(1,'width2_locaf','宽',$(this).val());
						});

						$('#height2_locaf').bind('focus',function(){
							textholder(0,'height2_locaf','高',$(this).val());
						});

						$('#height2_locaf').bind('blur',function(){
							textholder(1,'height2_locaf','高',$(this).val());
						});

						$('#width3_locaf').bind('focus',function(){
							textholder(0,'width3_locaf','宽',$(this).val());
						});

						$('#width3_locaf').bind('blur',function(){
							textholder(1,'width3_locaf','宽',$(this).val());
						});

						$('#height3_locaf').bind('focus',function(){
							textholder(0,'height3_locaf','高',$(this).val());
						});

						$('#height3_locaf').bind('blur',function(){
							textholder(1,'height3_locaf','高',$(this).val());
						});

		         		}else{
		         			alert('获取广告位数据失败');
		         		}
		         	},
		         error:function(){
						alert('获取广告位数据失败err');
					}
		       });

			break;
	}
}

/*	
  屏幕位置选择为“居中”时的处理
*/
function setScrLoca(val,tex,inp){
	if(val==tex){
		$('#'+inp).val(0);
		$('#'+inp).attr('disabled',true);
	}else{
		$('#'+inp).attr('disabled',false);
	}
}

/*
	处理尺寸选择处的切换
*/
function sizeType(id,s1,s2){
	var tpy=$('#'+id).attr('alt');
	if(tpy=='0'){
		$('#'+s1).fadeOut('fast',function(){
			$('#'+s2).fadeIn('fast');
			$('#'+id).text('选择常用尺寸');
			$('#'+id).attr('alt','1');
		});
	}else{
		$('#'+s2).fadeOut('fast',function(){
			$('#'+s1).fadeIn('fast');
			$('#'+id).text('自定义尺寸');
			$('#'+id).attr('alt','0');
		});
	}
	tips(id);
}

/*	
	onfocus、onblur 处理占位文字
*/
function textholder(tpy,id,tex,val){
	switch(tpy){
		case 0:
			if(tex==val){
				$("#"+id).val('');
				$("#"+id).css("color","#000");
			}
			break;
		case 1:
			if(tex==val || val==""){
				$("#"+id).val(tex);
				$("#"+id).css("color","#999");
			}
			break;
	}	
}

/*
	删除中心
	sta：1=是否删除  2=删除
	der：删除按钮的id
	ur：url
	did：被删除项的id
*/
function deleCenter(sta,der,ur,did){
	if(sta==1){
		setTimeout(function(){
			$('#'+der).css('background','#E94D43');
			$('#'+der).text('确认删除？');
			$('#'+der).attr('alt',2);
		},250);
	}else{
		$.ajax({
	         url:also_url()+ur+did,
	         type:"get",
	         beforeSend:function(){
	         		//loading
	           	},
	         success:function(d){
	         		var rs=eval('('+d+')');
	         		if(rs.status==1){
	         			also_remove($('#'+der).attr('sli'),$('#'+der).attr('loc'));

	         			$('#'+did).fadeOut('slow',function(){
	         				$(this).remove();
	         			}); 
	         		}
	         	},
	         error:function(){
					alert('获取广告位数据失败err');
				}
	       });
	}
}

/*	
 	获取频道内容
 	typ：1=广告列表处的select 2=新增广告处的select  3=系统设置处的列表
 	cho：1=选中最后一个
*/
function getChan(typ,cho){
	var dat=$('#datas_chan').val();
	if(dat==""){
		$.ajax({
         url:also_url()+'adseat/chn',
         type:"get",
         beforeSend:function(){
         		
           	},
         success:function(d){
         		var rs=eval('('+d+')');
         		if(rs.status==1){
         			var da=[];
					$('#datas_chan').val(d);
         			formatChan(typ,d);
         		}else{
         			alert('获取频道内容失败');
         		}
         	},
         error:function(){
				alert('获取频道内容err');
			}
       });
	}else{
		formatChan(typ,dat);
	}
	/*
		typ：1=广告列表处的select 2=新增广告处的select  3=系统设置处的列表
		dt：数据
	*/
	function formatChan(typ,dt){
		dt=eval('('+dt+')');
		var chan='';
		switch(typ){
			case 1:
				chan+='<option value="">选择所属频道(非必选)</option><option value="" disabled="disabled">-----</option>';
				$.each(dt.data,function(k,v){
					chan+='<option value="'+v.chnName+'">'+v.chnName+'</option>';
				});
				chan+='<option value="" disabled="disabled">-----</option><option value="add">新建频道</option>';
				$('#chan_locaf').empty().append(chan);
				if(cho==1){
					var lent=dt.data.length-1;
					$('#chan_locaf').val(dt.data[lent].chnName);
				}
				break;
			case 2:
				chan+='<option value="all">全部频道</option>';
				$.each(dt.data,function(k,v){
					chan+='<option value="'+v.chnName+'">'+v.chnName+'</option>';
				});
				var chanNow=$('#chan_now').val();
				$('#sele_chan').empty().append(chan);
				if(chanNow!=''){
					$('#sele_chan').val(chanNow);
				}
				break;
			case 3:
				break;
		}

		return chan;
	}	
}

/*
	验证-广告位
	typ：1=新增 2=编辑
*/
function sub_locaf(typ){

	var name=$('#name_locaf').val(),
		chan=$('#chan_locaf').val(),
		type=$('input[name="spe"]:checked').val();

	if(checkStation(name,1,'广告位名称')==false){
		tips('name_locaf','请填写广告位名称','name_locaf');
		return;
	}else{
		tips('name_locaf');
	}

	if(checkStation(type,2)==true){
		tips('tt_locaf');
		if(type<3){
			if(pushSizes($('#t_size1_locaf').attr('alt'),'size1_locaf','pri','width1_locaf','height1_locaf')==false){
				return;
			}
			if(type==2){
				if(checkStation($('#ver_locaf').val(),3)==true){
					tips('screenPo_locaf');
				}else{
					tips('screenPo_locaf','边距不能为空且必须是数字','ver_locaf');
					return;
				}

				if(checkStation($('#hor_locaf').val(),3)==true){
					tips('screenPo_locaf');
				}else{
					tips('screenPo_locaf','边距不能为空且必须是数字','hor_locaf');
					return;
				}

				if(checkStation($('#stp_locaf').val(),3)==false){
					tips('btn_stp_locaf','停留时间不能为空且必须是数字','stp_locaf');
					return;
				}else{
					tips('btn_stp_locaf');
				}
			}
		}else if(2<type<=4){
			if(pushSizes($('#t_size2_locaf').attr('alt'),'size2_locaf','pri','width2_locaf','height2_locaf')==true){
				if(pushSizes($('#t_size3_locaf').attr('alt'),'size3_locaf','aux','width3_locaf','height3_locaf')==false){
					return;
				}
			}else{
				return;
			}
		}
	}else{
		tips('tt_locaf','请选择广告位形式');
		return;
	}

	/*	
		 处理尺寸的获取问题（自定义尺寸和常用尺寸）
		 tpy：0常用  1自定义
		 sid：select的id
		 st：priSize(主尺寸) auxSize(副尺寸)
		 wid：自定义宽的id
		 hid：自定义高的id
	*/
	function pushSizes(tpy,sid,st,wid,hid){
		if(tpy==0){
			var siz=$('#'+sid).val();
				if(siz==""){
					tips('t_'+sid,'请选择尺寸',sid);
					return false;
				}else{
					$('input[name="'+st+'"]').val(siz);
				}
		}else{
			var ww=$('#'+wid).val(),
				hh=$('#'+hid).val(),
				rw=checkStation(ww,4,'宽'),
				rh=checkStation(hh,4,'高');
			 if(rw && rh){
				$('input[name="'+st+'"]').val(ww+'x'+hh);
			 }else{
			 	if(rh==false){
			 		tips('t_'+sid,'请输入尺寸(只能为大于0的正整数)',hid);
			 	}
			 	if(rw==false){
			 		tips('t_'+sid,'请输入尺寸(只能为大于0的正整数)',wid);
			 	}
			 	return false;
			 }
		}
		tips('t_'+sid);
		return true;
	}

	if(typ==1){
		subData(1,'form_locaf','adseat/add','save_locaf','cancel_locaf','正在保存...','保存广告位');
	}else{
		subData(3,'form_locaf','adseat/upd','save_locaf','cancel_locaf','正在保存...','保存广告位');
	}
}

/*
	验证-新增频道
*/
function sub_chanf(){
	var name=$('#name_chanf').val(),dat=$('#datas_chan').val();
	if(checkStation(name,1,'频道名称')==false){
		tips('name_chanf','请填写频道名称','name_chanf');
		return;
	}else{
		tips('name_chanf');
		if(dat!=""){
			var isRep=0;
			dat=eval('('+dat+')');
			$.each(dat.data,function(k,v){
				if(v.chnName==name){
					isRep=1;
				}
			});
			if(isRep!=0){
				tips('name_chanf','频道已存在','name_chanf');
				return;
			}else{
				tips('name_chanf');
			}
		}
	}

	subData(2,'form_chanf','adseat/newchn','save_chanf','cancel_chanf','正在保存...','保存频道');
}


/*	
	提交表单的公用方法
	typ：1=新增广告位  2=新增频道  3=编辑广告位
	fid：form的id
	ur：处理页地址
	bid：提交按钮id
	cid：取消按钮id
	ing：beforeSend文字
	wor: 按钮原有文字
*/
function subData(typ,fid,ur,bid,cid,ing,wor){
	$.ajax({
         url:also_url()+ur,
         data:$('#'+fid).serialize(),
         type:"post",
         beforeSend:function(){
         		$('#'+bid).text(ing);
         		$('#'+bid).removeClass().addClass(bid+'_2');
				$('#'+bid).attr('disabled',true);
           	},
         success:function(d){
         		var rs=eval('('+d+')');
         		if(rs.status==1){
         			switch(typ){
         				case 1:
         					getNewData(2,rs.data);		
         					break;
         				case 2:
         					$('#datas_chan').val('');
         					getChan(1,1);
         					getChan(2);
         					break;
         				case 3:
         					getNewData(3,$('#eid_locaf').val());
         					break;
     				}
         			also_remove($('#'+bid).attr('sli'),$('#'+bid).attr('loc'));
         		}else{
         			tips(cid,'提交失败，请稍后再试');
         			$('#'+bid).attr('disabled',false);
         			$('#'+bid).text(wor);
         			$('#'+bid).removeClass().addClass(bid+'_1');
         		}
         	},
         error:function(){
				tips(cid,'提交失败，请稍后再试');
				$('#'+bid).attr('disabled',false);
				$('#'+bid).text(wor);
         		$('#'+bid).removeClass().addClass(bid+'_1');
			}
       });
}

/*	
	新增数据成功后请求最新的一条数据
	typ：2=广告位（新增成功后）3=广告位（编辑成功后）
	nid：最新数据的id
*/
function getNewData(typ,nid){
	var ur='';
	switch(typ){
		case 2:
			ur='adseat/inf/';
			getAnum('adseat/cnt','topic_loca_num1');
			break;
		case 3:
			ur='adseat/inf/';
			//需要更新正在投放广告位的数据
			//需要广告位的状态
			break;
	}

	$.ajax({
         url:also_url()+ur+nid,
         type:"get",
         beforeSend:function(){
         		//列表loading
           	},
         success:function(d){
         		var rs=eval('('+d+')');
         		if(rs.status==1){
         			formatData(typ,rs.data);			
         		}else{
         			alert('获取广告数据失败--新增成功后');
         		}
           		
         	},
         error:function(){
				alert('err--新增成功后');
			}
       });
}


/*	
	在获取的数据被格式化以后加入到list中
	用于处理出现时有特效的情况
	typ：1=广告位，2=广告位（新增成功后）
	cod：html代码
	eid：被编辑项的id
*/
function setDataInlist(typ,cod,eid){
	switch(typ){
		case 1:
			$('#contBox').empty().append(cod); //装载对应分页的内容

 			$('a[name="edits_loca"]').bind('click',function(){
				also_filler(2,'main_loca','编辑广告位','main',$(this).attr('alt'));
			});
			$('a[name="adJoinLoca"]').bind('click',function(){
				also_filler(7,'main_loca','新增广告到广告位'+$(this).attr('na'),'main',$(this).attr('alt'));
			});
			$('a[name="getJS"]').bind('click',function(){
				also_filler(9,'main_loca',$(this).attr('na'),'main',$(this).attr('alt'));
			});
			break;
		case 2:
			$('#contBox').prepend(cod);
			$('#contBox div:first').animate({opacity:'1'},1200);

			break;
		case 3:
			// $('#'+eid).animate({opacity:'0'},300,function(){

			// });
			$('#'+eid).fadeOut('slow',function(){
				$(this).before(cod);
				$('#'+eid).animate({opacity:'1'},1200);
				$(this).remove();
			});
	}
}

/*	
	表单验证中心
	val：要验证的值
	tpy：要验证的类型(1:空  2：空+undefined  3：空+undefined+数字 4：空+undefined+数字+正整数)
	hol：占位文本
*/
function checkStation(val,tpy,hol){

	var result=true;
	if(typeof(hol)!="undefined"){
		if(val==hol){
			result=false;
		}
	}

	if(tpy>3){
		var num=/^[1-9]*[1-9][0-9]*$/;
		if(!num.test(val)){
			result=false;
		}

	}
	if(tpy>2){
		if(isNaN(val)){
			result=false;
		}
	}
	if(tpy>1){
		if(typeof(val)=="undefined"){
			result=false;
		}
	}
	if(tpy>0){
		if(val==""){
			result=false;
		}
	}
	return result;
}

/*
	 按分隔符截取字符串
	 num：取第几位
	 sign:分隔符
	 tex：字符串
*/
function cutText(num,sign,tex){
	 var result=tex.split(sign);
	 return result[num];
}


/*
	 表单提示
	 dad: 父元素id
	 tex：提示内容,没有内容则删除已存在的tip
	 foc：focus 
	 col：文字颜色
*/
function tips(dad,tex,foc,col){
	if(typeof(tex)!='undefined'){
		if($('#tips_'+dad).size()==0){
			var hei=$('#'+dad).parent().css('height');
			var tip='<span id="tips_'+dad+'" class="also_tips" style="color:'+(col?col:'#ef651a')+';line-height:'+hei+';">';
			tip+=tex;
			tip+='</span>';

			$('#'+dad).after(tip);
		}

		if(typeof(foc)!='undefined'){
				$('#'+foc).focus();
			}

	}else{
		$('#tips_'+dad).remove();
	}	
}


/*
	 气泡提示指挥中心
	 typ：1=新增广告位
*/
function bubble(typ){
	switch(typ){
		case 1:
			bubtips('cra_tips','Crazy广告位','解释解释解释解释解，释解释解释解释解释解，释解释解释，解释解释解释解释解释解释。<a href="#">查看demo</a>');
			bubtips('pip_tips','PIP扩展广告位','解释解释解释解释解，释解释解释解释解释解，解释解释解释解释。<a href="#">查看demo</a>');
			break;

		default:
			break;

	}
}

/*
	 调用气泡方法
	 dad：调用者id
	 tit：标题
	 tex：内容
*/
function bubtips(dad,tit,tex){
	var cont='<div class="tit_bub">'+tit+'</div>';
		cont+='<div class="cont_bub">'+tex+'</div>';
	$('#'+dad).poshytip({
		className: 'tip-fff',
		showTimeout: 1,
		alignTo: 'target',
		alignX: 'right',
		alignY: 'bottom',
		offsetY: 16,
		content: cont
	});
}


/*
	 分页设置中心
	 tpy：1=广告位
*/
function pageStation(typ){
	var ur='',ul='',chan=$('#sele_chan').val(),sta=$('#sele_state').val();
	if(chan==null){
		chan="all";
	}
	if(sta==null){
		sta="all";
	}
	switch(typ){
		case 1:
			ur='adseat/cnt/'+chan+'/'+sta;
			ul='adseat/index/';
			//获取总数，初始化分页方法
			break;
	}

	$.ajax({
         url:also_url()+ur,
         type:"get",
         beforeSend:function(){
         		//loading
           	},
         success:function(d){
         		var rs=eval('('+d+')');
         		if(rs.status==1){
         			var numb=parseInt(rs.data/5),mo=parseInt(rs.data%5);
         			numb = mo>0?(numb+1):numb;
         			$("#pgs_box").pagination(numb,{
						num_edge_entries: 1, //边缘页数
						num_display_entries: 5, //主体页数
						callback: pageselectCallback,
						items_per_page: 1, //每页显示1项
						prev_text: "上一页",
						next_text: "下一页"
					});
         		}else{
         			alert('获取失败');
         		}
         	},
         error:function(){
				alert('err');
			}
       });

	function pageselectCallback(page_index,jq){
		$.ajax({
	         url:also_url()+ul+(page_index+1)+'/'+chan+'/'+sta,
	         type:"get",
	         beforeSend:function(){
	         		//loading
	           	},
	         success:function(d){
	         		var rs=eval('('+d+')');
	         		if(rs.status===1){
	         			formatData(typ,rs.data.sea);
						return false;
	         		}else{
	         			alert('获取失败');
	         		}
	         	},
	         error:function(){
					alert('err');
				}
       });
	}
}	

/*	
	 列表数据整理中心
	 typ：1=广告位 2=广告位（新增成功后） 3=广告位（编辑成功后）
	 data：json数据
*/
function formatData(typ,data){
	var code='',eid='';
	switch(typ){
		case 1:
			var shap='',chan='',priSi='',listCla='',pu='';
			$.each(data,function(k,v){
					priSi='<span id="list_size_loca" title="尺寸">'+v.priSize[0]+'x'+v.priSize[1]+'</span>';
					switch(v.shape){
						case '1':
							shap='banner';
							break;
						case '2':
							shap='漂浮';
							break;
						case '3':
							shap='Crazy';
							priSi='';
							break;
						case '4':
							shap='PIP扩展';
							priSi='';
							break;

					}

					if(v.chnName==0){
						chan='';
					}else{
						chan='('+v.chnName+')';
					}

					var text='';
					if(v.put==-1){
						listCla='pla_loca';
						pu='计划';
					}else if(v.put==0){
						listCla='non_loca';
						pu='空闲';
					}else if(v.put>0){
						listCla='ing_loca';
						pu=v.put;
						text='正在投放';
					}

					code+='<div id="'+v._id+'" class="list_loca '+listCla+'">';
				   	code+='<div class="list_left_loca">';
				   	code+='<p class="list_tit_loca"><a href="#">'+v.name+'</a><span id="list_chan_loca" title="所属频道">'+chan+'</span></p>';
				   	code+='<p class="list_oth_loca">';
				   	code+=priSi;
				   	code+='<span id="list_type_loca" title="形式">'+shap+'</span>';
				   	code+='</p>';
				   	code+='</div>';
				   	code+='<div class="list_state_loca">';
				   	code+='<p>'+text+'</p>';
				   	code+='<p id="list_snum_loca">'+pu+'</p>';
				   	code+='</div>';
				   	code+='<div class="list_ops_loca">';
				   	code+='<a alt="'+v._id+'" name="edits_loca" href="javascript:void(0)">编辑</a>';
				   	code+='<a alt="'+v._id+'" na="'+v.name+'" name="adJoinLoca" href="javascript:void(0)">投放广告</a>';
				   	code+='<a href="javascript:void(0)">查看统计</a>';
				   	code+='<a alt="'+v._id+'" na="'+v.name+'" name="getJS" href="javascript:void(0)">获取代码</a>';
				   	code+='</div>';
				   	code+='</div>';
			});

			break;
		case 2:
			var shap='',chan='',priSi='',listCla='',pu='',text='';
			priSi='<span id="list_size_loca" title="尺寸">'+data.priSize[0]+'x'+data.priSize[1]+'</span>';
			switch(data.shape){
				case '1':
					shap='banner';
					break;
				case '2':
					shap='漂浮';
					break;
				case '3':
					shap='Crazy';
					priSi='';
					break;
				case '4':
					shap='PIP扩展';
					priSi='';
					break;

			}

			if(data.chnName==0){
				chan='';
			}else{
				chan='('+data.chnName+')';
			}

			if(data.put==-1){
				listCla='pla_loca';
				pu='计划';
			}else if(data.put==0){
				listCla='non_loca';
				pu='空闲';
			}else if(data.put>0){
				listCla='ing_loca';
				pu=data.put;
				text='正在投放';
			}

			code+='<div id="'+data._id+'" class="list_loca '+listCla+'" style="opacity:0.1;">';
		   	code+='<div class="list_left_loca">';
		   	code+='<p class="list_tit_loca">'+data.name+'<span id="list_chan_loca" title="所属频道">'+chan+'</span></p>';
		   	code+='<p class="list_oth_loca">';
		   	code+=priSi;
		   	code+='<span id="list_type_loca" title="形式">'+shap+'</span>';
		   	code+='</p>';
		   	code+='</div>';
		   	code+='<div class="list_state_loca">';
		   	code+='<p>'+text+'</p>';
		   	code+='<p id="list_snum_loca">'+pu+'</p>';
		   	code+='</div>';
		   	code+='<div class="list_ops_loca">';
		   	code+='<a alt="'+data._id+'" name="edits_loca" onclick="also_filler(2,\'main_loca\',\'编辑广告位\',\'main\',\''+data._id+'\');" href="javascript:void(0)">编辑</a>';
		   	code+='<a alt="'+data._id+'" onclick="also_filler(7,\'main_loca\',\'新增广告到广告位'+data.name+'\',\'main\',this.alt);" name="adJoinLoca" href="javascript:void(0)">投放广告</a>';
		   	code+='<a href="javascript:void(0)">查看统计</a>';
		   	code+='<a alt="'+data._id+'" onclick="also_filler(9,\'main_loca\',\''+data.name+'\',\'main\',this.alt);" name="getJS" href="javascript:void(0)">获取代码</a>';
		   	code+='</div>';
		   	code+='</div>';

			break;
		case 3:
			var shap='',chan='',priSi='',listCla='',pu='',text='';
			priSi='<span id="list_size_loca" title="尺寸">'+data.priSize[0]+'x'+data.priSize[1]+'</span>';
			switch(data.shape){
				case '1':
					shap='banner';
					break;
				case '2':
					shap='漂浮';
					break;
				case '3':
					shap='Crazy';
					priSi='';
					break;
				case '4':
					shap='PIP扩展';
					priSi='';
					break;

			}

			if(data.chnName==0){
				chan='';
			}else{
				chan='('+data.chnName+')';
			}

			if(data.put==-1){
				listCla='pla_loca';
				pu='计划';
			}else if(data.put==0){
				listCla='non_loca';
				pu='空闲';
			}else if(data.put>0){
				listCla='ing_loca';
				pu=data.put;
				text='正在投放';
			}

			code+='<div id="'+data._id+'" class="list_loca '+listCla+'" style="opacity:0.1;">';
		   	code+='<div class="list_left_loca">';
		   	code+='<p class="list_tit_loca">'+data.name+'<span id="list_chan_loca" title="所属频道">'+chan+'</span></p>';
		   	code+='<p class="list_oth_loca">';
		   	code+=priSi;
		   	code+='<span id="list_type_loca" title="形式">'+shap+'</span>';
		   	code+='</p>';
		   	code+='</div>';
		   	code+='<div class="list_state_loca">';
		   	code+='<p>'+text+'</p>';
		   	code+='<p id="list_snum_loca">'+pu+'</p>';
		   	code+='</div>';
		   	code+='<div class="list_ops_loca">';
		   	code+='<a alt="'+data._id+'" name="edits_loca" onclick="also_filler(2,\'main_loca\',\'编辑广告位\',\'main\',\''+data._id+'\');" href="javascript:void(0)">编辑</a>';
		   	code+='<a alt="'+data._id+'" onclick="also_filler(7,\'main_loca\',\'新增广告到广告位'+data.name+'\',\'main\',this.alt);" name="adJoinLoca" href="javascript:void(0)">投放广告</a>';
		   	code+='<a href="javascript:void(0)">查看统计</a>';
		   	code+='<a alt="'+data._id+'" onclick="also_filler(9,\'main_loca\',\''+data.name+'\',\'main\',this.alt);" name="getJS" href="javascript:void(0)">获取代码</a>';
		   	code+='</div>';
		   	code+='</div>';
		   	eid=data._id;
			break;
	}
				
	setDataInlist(typ,code,eid);
}



/*	
	 当仅需从服务器获取一个数字并添加到页面时 
	 ur：url
	 inid：append的元素id	 
*/
function getAnum(ur,inid){
	$.ajax({
         url:also_url()+ur,
         type:"get",
         beforeSend:function(){
         		//loading
           	},
         success:function(d){
         		var rs=eval('('+d+')');
         		if(rs.status==1){
         			$('#'+inid).empty().append(rs.data);
         		}
         	},
         error:function(){
				alert('err');
			}
       });
}