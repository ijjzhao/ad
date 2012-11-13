/*
* 滑层
* typ：类型
* dad：父层id
* tit：标题
* locker：用于锁定/解开父层的纵向滚动条
*/
function also_slider(typ,dad,tit,locker){
	var num=$('.also_slider').size()+1;
	var sli={
		id:'also_slider_'+num,
		zin:num*100,
		left:88+(num*36),
		lock:'also_slider_'+num+'_lock',
		lzin:num*90
	}

	var d ='<div id="'+sli.lock+'" class="also_locker" onclick="also_remove(\''+sli.id+'\',\''+locker+'\')" title="点击关闭【'+tit+'】" style="z-index:'+sli.lzin+';" ></div>';
		d+='<div id="'+sli.id+'" style="z-index:'+sli.zin+';" class="also_slider"><a class="also_close" href="javascript:void(0)" onclick="also_remove(\''+sli.id+'\',\''+locker+'\')" alt="关闭【'+tit+'】" title="关闭【'+tit+'】"></a>'+also_filler(typ,sli.id,tit,locker)+'</div>';

	$('#'+dad).append(d);
	$('#'+sli.id).animate({
		marginLeft:sli.left,
		width:'100%',
		opacity:'1'
	},400);
	$('#'+locker).css('overflow-y','hidden');
	bubble(typ);
}

/*
* 删除滑层
* id：slider的id
* locker：locker的id
*/
function also_remove(id,locker){
	$('#'+id).animate({
		opacity:0,
		marginLeft: 1174,
		width:0
	},400,function(){
		$('#'+id+'_lock').remove();
		$('#'+id).remove();
	});
	$('#'+locker).css('overflow-y','auto');
}

/* 
* 滑层内容集中营
* typ：类型
* fid：父层id
* tit：标题
* locker：用于锁定/解开父层的纵向滚动条
*/
function also_filler(typ,fid,tit,locker){
	var codes='';
	switch(typ){
		case 0:
			codes=0;
			break;
		case 1:
			//新增广告位
			codes='<div class="addSi"><form id="form_addSi">';
			codes+='<p class="topic_addSi">'+tit+'</p>';
			codes+='<div class="board_addSi"><p class="tit_addSi">基本信息</p>';
			codes+='<p class="cont_addSi"><input id="name_addSi" name="ana" type="text" value="广告位名称"></p>';
			codes+='<p class="cont_addSi"><input id="remark_addSi" name="des" type="text" value="备注" ></p>';
			codes+='<p class="cont_addSi"><select id="chan_addSi" name="chn" onchange="if(this.value==\'add\'){also_slider(2,\''+fid+'\',\'新建频道\',\''+fid+'\');$(this).val(\'0\')}">'+getChan()+'</select></p>';
			codes+='</div>';
			codes+='<div class="board_addSi"><p class="tit_addSi"><span id="tt_addSi">广告位形式</span></p>';
			codes+='<p class="tts_addSi"><span><input name="spe" id="t1_addSi" value="1" title="固定" type="radio"><label for="t1_addSi">固定</label></span>';
			codes+='<span><input name="spe" id="t2_addSi" value="2" title="漂浮" type="radio"><label for="t2_addSi">漂浮</label></span>';
			codes+='<span><input name="spe" id="t3_addSi" value="3" title="Crazy" type="radio"><label for="t3_addSi">Crazy</label><a id="cra_tips" class="also_helper" href="javascript:void(0)">?</a></span>';
			codes+='<span><input name="spe" id="t4_addSi" value="4" title="PIP扩展" type="radio"><label for="t4_addSi">PIP扩展</label><a id="pip_tips" class="also_helper" href="javascript:void(0)">?</a></span>';
			codes+='</p>';
			codes+='<div id="base_addSi"></div></div>';
			codes+='<div class="board_addSi"><p class="tru_addSi"><input id="trust_addSi" name="psh" type="checkbox"><label for="trust_addSi">接受锦途推送的广告</label></p>';
			codes+='<p class="tru1_addSi">*勾选此项则我们会根据您的网站类型推荐广告给您，您可以选择接受或者不投放</p>';
			codes+='</div>';
			codes+='<div class="btns_addSi">';
			codes+='<a id="save_addSi" sli="'+fid+'" loc="'+locker+'"  class="save_addSi_1" >保存广告位</a>';
			codes+='<a id="cancel_addSi" href="javascript:void(0)" onclick="also_remove(\''+fid+'\',\''+locker+'\')">取消</a>';
			codes+='</div>';
			codes+='<input type="hidden" name="pri"><input type="hidden" name="aux">'
			codes+='</form></div>';
			$('#save_addSi').live('click',function(){
				sub_addLoca()
			});			
			break;
		case 2:
			//新增频道
			codes='<div class="addChan">';
			codes+='<h2>'+tit+'</h2>';
			codes+='</div>';
			break;
		default:
			codes="oops";
	}

	$('#name_addSi').live('focus',function(){
		textholder(0,'name_addSi','广告位名称',$(this).val());
	});

	$('#name_addSi').live('blur',function(){
		textholder(1,'name_addSi','广告位名称',$(this).val());
	});

	$('#remark_addSi').live('focus',function(){
		textholder(0,'remark_addSi','备注',$(this).val());
	});

	$('#remark_addSi').live('blur',function(){
		textholder(1,'remark_addSi','备注',$(this).val());
	});

	$('input[name="spe"]').live('click',function(){
		var va=parseInt($(this).val()),name=$(this).attr('title'),co='';
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

		co='<p class="tit2_addSi">请选择'+name+'广告位的尺寸</p>';

		if(va<=2){
			co+='<p class="sis_addSi"><select id="size1_addSi" name="size_addSi">'+siz;
			co+='</select><span id="diy1_addSi"><input id="width1_addSi" type="text" class="intex_addSi" value="宽">&nbsp;x&nbsp;<input id="height1_addSi" type="text" class="intex_addSi" value="高">&nbsp;(px)</span><a id="t_size1_addSi" alt="0" href="javascript:void(0)" onclick="sizeType(this.id,\'size1_addSi\',\'diy1_addSi\')">自定义尺寸</a></p>';
			if(va==2){
				co+='<p class="tit2_addSi"><span id="screenPo_addSi">屏幕位置</span></p>';
				co+='<p class="sis_addSi"><select id="gty_addSi" name="gty" onchange="setScrLoca(this.value,\'middle\',\'ver_addSi\')"><option value="top">居上</option><option value="middle">居中</option><option value="bottom">居下</option></select>';
				co+='<span class="borp_addSi">边距：<input id="ver_addSi" name="ver" type="text">(px)</span></p>';
				co+='<p class="sis_addSi"><select id="ore_addSi" name="ore" onchange="setScrLoca(this.value,\'center\',\'hor_addSi\')"><option value="left">居左</option><option value="center">居中</option><option value="right">居右</option></select>';
				co+='<span class="borp_addSi">边距：<input id="hor_addSi" name="hor" type="text">(px)</span></p>';
				co+='<p class="tit2_addSi">停留时间</p>';
				co+='<p class="sis_addSi"><span id="stp1_addSi">[不限]</span><span id="stp2_addSi"><input id="stp_addSi" name="stp" value="-1" type="text">(秒)</span><a id="btn_stp_addSi" href="javascript:void(0)" onclick="">更改</a></p>';
				co+='<p class="tit2_addSi"><input id="sll_addSi" name="sll" type="checkbox"><label for="sll_addSi">跟随滚动条</label><a>?</a></p>';
			}

			$('#width1_addSi').live('focus',function(){
				textholder(0,'width1_addSi','宽',$(this).val());
			});

			$('#width1_addSi').live('blur',function(){
				textholder(1,'width1_addSi','宽',$(this).val());
			});

			$('#height1_addSi').live('focus',function(){
				textholder(0,'height1_addSi','高',$(this).val());
			});

			$('#height1_addSi').live('blur',function(){
				textholder(1,'height1_addSi','高',$(this).val());
			});

		}else if(2<va<=4){
			co+='<p class="sis_addSi">主画面：<select id="size2_addSi" name="size_addSi">'+siz;
			co+='</select><span id="diy2_addSi"><input id="width2_addSi" type="text" class="intex_addSi" value="宽">&nbsp;x&nbsp;<input id="height2_addSi" type="text" class="intex_addSi" value="高">&nbsp;(px)</span><a id="t_size2_addSi" alt="0" href="javascript:void(0)" onclick="sizeType(this.id,\'size2_addSi\',\'diy2_addSi\')">自定义尺寸</a></p>';

			co+='<p class="sis_addSi">副画面：<select id="size3_addSi" name="size_addSi">'+siz;
			co+='</select><span id="diy3_addSi"><input id="width3_addSi" type="text" class="intex_addSi" value="宽">&nbsp;x&nbsp;<input id="height3_addSi" type="text" class="intex_addSi" value="高">&nbsp;(px)</span><a id="t_size3_addSi" alt="0" href="javascript:void(0)" onclick="sizeType(this.id,\'size3_addSi\',\'diy3_addSi\')">自定义尺寸</a></p>';

				$('#width2_addSi').live('focus',function(){
					textholder(0,'width2_addSi','宽',$(this).val());
				});

				$('#width2_addSi').live('blur',function(){
					textholder(1,'width2_addSi','宽',$(this).val());
				});

				$('#height2_addSi').live('focus',function(){
					textholder(0,'height2_addSi','高',$(this).val());
				});

				$('#height2_addSi').live('blur',function(){
					textholder(1,'height2_addSi','高',$(this).val());
				});

				$('#width3_addSi').live('focus',function(){
					textholder(0,'width3_addSi','宽',$(this).val());
				});

				$('#width3_addSi').live('blur',function(){
					textholder(1,'width3_addSi','宽',$(this).val());
				});

				$('#height3_addSi').live('focus',function(){
					textholder(0,'height3_addSi','高',$(this).val());
				});

				$('#height3_addSi').live('blur',function(){
					textholder(1,'height3_addSi','高',$(this).val());
				});
		}
		$("#base_addSi").empty();
		$("#base_addSi").append(co);

		$('#btn_stp_addSi').live('click',function(){
			var val=$('#stp_addSi').val();
			if(val=='-1'){
				$('#stp1_addSi').fadeOut('fast',function(){
					$('#stp2_addSi').fadeIn();
					$('#btn_stp_addSi').text('不限');
					$('#stp_addSi').val('60');
				});
			}else{
				$('#stp2_addSi').fadeOut('fast',function(){
					$('#stp1_addSi').fadeIn();
					$('#btn_stp_addSi').text('更改');
					$('#stp_addSi').val('-1');
				});
			}
		});
	});
	
	return codes;
}


/*
* 屏幕位置选择为“居中”时的处理
*/
function setScrLoca(val,tex,inp){
	if(val==tex){
		$('#'+inp).val(0);
		$('#'+inp).attr('disabled',true);
	}else{
		$('#'+inp).val('');
		$('#'+inp).attr('disabled',false);
	}
}

/*处理尺寸选择处的切换*/
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

/*onfocus、onblur 处理占位文字*/
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

/*获取频道内容*/
function getChan(id){
	//id为广告位的id,新增时，后端只需返回所有的频道信息；修改时，后端返回所有频道信息的同时还要返回这个广告位所属频道的id.
	//目前为模拟数据，真实数据从后端获取
	//获取后存放至全局变量中，避免频繁请求
	var chan='';
	chan='<option value="">选择所属频道(非必选)</option>';
	chan+='<option value="" disabled="disabled">-----</option>';
	chan+='<option value="主站">主站</option>';
	chan+='<option value="教育">教育</option>';
	chan+='<option value="体育">体育</option>';
	chan+='<option value="" disabled="disabled">-----</option>';
	chan+='<option value="add">新建频道</option>';
	return chan;
}

/*提交-新增广告位*/
function sub_addLoca(){

	var name=$('#name_addSi').val(),
		chan=$('#chan_addSi').val(),
		type=$('input[name="spe"]:checked').val();

	if(checkStation(name,0,'广告位名称')==false){
		tips('name_addSi','请填写广告位名称','name_addSi');
		return;
	}else{
		tips('name_addSi');
	}

	if(checkStation(type,2)==true){
		tips('tt_addSi');
		if(type<3){
			if(pushSizes($('#t_size1_addSi').attr('alt'),'size1_addSi','pri','width1_addSi','height1_addSi')==false){
				return;
			}
			if(type==2){
				if(checkStation($('#ver_addSi').val(),3)==true){
					tips('screenPo_addSi');
				}else{
					tips('screenPo_addSi','边距不能为空且必须是整数','ver_addSi');
					return;
				}

				if(checkStation($('#hor_addSi').val(),3)==true){
					tips('screenPo_addSi');
				}else{
					tips('screenPo_addSi','边距不能为空且必须是整数','hor_addSi');
					return;
				}

				if(checkStation($('#stp_addSi').val(),3)==false){
					tips('btn_stp_addSi','停留时间不能为空且必须是数字','stp_addSi');
					return;
				}else{
					tips('btn_stp_addSi');
				}
			}
		}else if(2<type<=4){
			if(pushSizes($('#t_size2_addSi').attr('alt'),'size2_addSi','pri','width2_addSi','height2_addSi')==true){
				if(pushSizes($('#t_size3_addSi').attr('alt'),'size3_addSi','aux','width3_addSi','height3_addSi')==false){
					return;
				}
			}else{
				return;
			}
		}
	}else{
		tips('tt_addSi','请选择广告位形式');
		return;
	}
	/*
	* 处理尺寸的获取问题（自定义尺寸和常用尺寸）
	* tpy：0常用  1自定义
	* sid：select的id
	* st：priSize(主尺寸) auxSize(副尺寸)
	* wid：自定义宽的id
	* hid：自定义高的id
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

	subData('form_addSi','http://localhost/ad/index.php/adseat/add','save_addSi','cancel_addSi','正在保存...','保存广告位');

}

/*
* 提交表单的公用方法
* fid：form id
* ur：处理页地址
* bid：提交按钮id
* cid：取消按钮id
* ing：beforeSend文字
* wor: 按钮原有文字
*/
function subData(fid,ur,bid,cid,ing,wor){
	$.ajax({
         url:ur,
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
         			also_remove($('#'+bid).attr('sli'),$('#'+bid).attr('loc'));
         			alert('调用列表加载方法，将最新的一条数据插入列表');
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
* 表单验证中心
* val：要验证的值
* tpy：要验证的类型(1:空  2：空+undefined  3：空+undefined+数字 4：空+undefined+数字+正整数)
* hol：占位文本
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
* 按分隔符截取字符串
* num：取第几位
* sign:分隔符
* tex：字符串
*/
function cutText(num,sign,tex){
	 var result=tex.split(sign);
	 return result[num];
}


/*
* 表单提示
* dad: 父元素id
* tex：提示内容,没有内容则删除已存在的tip
* foc：focus 
* col：文字颜色
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
* 气泡提示指挥中心
* typ：1=新增广告位
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
* 调用气泡方法
* dad：调用者id
* tit：标题
* tex：内容
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