<?php
//+-------------------------------
//+ 广告位逻辑处理控制器
//+ Time:2012-11-09 19:43 
//+ Author: zjs
//+-------------------------------
class AdseatAction extends SspAction{
	/**
	* 广告位数据获取
	*/
	public function index(){
		$return_arr = array();			//定义内容输出数组
		$site = $this->getWebSite();
		if($site){	//验证是否有站点数据
			$chnnel_name_arr = array();						//频道名称列表
			foreach ($site['channel'] as $k => $v) {
				$chnnel_name = $v['chnName'];				//获取当前频道的名称
				array_push($chnnel_name_arr,$chnnel_name);	//将频道名称添加到频道名称列表中
			}
			$return_arr['channel'] = $chnnel_name_arr;		//设置要输出的频道信息
			//获取当前站点下的所有广告位
			$adseat = new AdseatModel();	//实例化广告位模型对象
			$seat_arr = $adseat->selectBySiteid($site['_id']);
			$seat_info_arr = array();
			foreach ($seat_arr as $k => $v) {
				$v['_id'] = $v['_id'].id;
				if(!$v['auxSize']['width'] || !$v['auxSize']['height']){
					unset($v['auxSize']);//移出不需要的元素
				}
				array_push($seat_info_arr, $v);
			}
			$return_arr['seats'] = $seat_info_arr;			//设置要输出的频道信息
		}
		$json_str = json_encode($return_arr);
		echo $json_str;
	}
	/**
	* 新增广告位
	*/
	public function add(){
		if($this->isPost()){//获取提交才数据
			if(!empty($_POST['ana']) && !empty($_POST['spe']) && !empty($_POST['pri']) && !empty($_POST['des'])){//验证必须提交的数据是否存在
				$site = $this->getWebSite();
				$arr = array(
					'name' => $_POST['ana'],
					'shape' => $_POST['spe'],
					'priSize' => explode('x',$_POST['pri']),
					'website' => new MongoId($site['_id'])
				);//定义存储的内容
				$arr['desc'] = $_POST['des'] == '备注' ? '' : $_POST['des'];
				$arr['auxSize'] = empty($_POST['aux']) ? 0 : explode('x', $_POST['aux']);
				$arr['chnName'] = empty($_POST['chn']) ? 0 : $_POST['chn'];
				$arr['isPush'] = empty($_POST['psh']) ? 'off' : 'on';
				$arr['isScroll'] = empty($_POST['sll']) ? 'off' : 'on';
				$arr['reTime'] = empty($_POST['stp']) ? -1 : $_POST['stp'];
				$arr['layout']['orientation'] = empty($_POST['ore']) ? 0 : $_POST['ore'];
				$arr['layout']['gavity'] = empty($_POST['gty']) ? 0 : $_POST['gty'];
				$arr['layout']['vertical'] = empty($_POST['ver']) ? 0 : $_POST['ver'];
				$arr['layout']['horizontal'] = empty($_POST['hor']) ? 0 : $_POST['hor'];
				//实例化广告位模型对象
				$adseat_model = new AdseatModel();
				$rs = $adseat_model->addNewSeat($arr);
				$this->ajaxReturn('','',$rs['ok']);
			}else{
				$this->ajaxReturn('','信息不完整',0);
			}
		}else{
			$this->ajaxReturn('','请求错误',0);
		}
	}
	/**
	* 获取当前用户的站点（单个）
	*/
	private function getWebSite(){
		$usr_info = session('adusr');	//获取session中登录用户的信息
		$usr_id = $usr_info['_id'];		//获取用户的编号
		$website = new WebsiteModel();	//实例化站点模型对象
		$site_info = $website->findByUid($usr_id);	//根据uid查找站点
		$site_id = $site_info['_id'].id;
		return $site_info;
	}
	/**
	* 获取当前用户站点的编号
	*/
	public function getWebSiteId(){
		$site_id = '';
		$usr = session('adusr');
		if(array_key_exists('siteId', $usr)){
			$site_id = $usr['siteId']; 		
		}else{
			$usr_info = session('adusr');	//获取session中登录用户的信息
			$usr_id = $usr_info['_id'];		//获取用户的编号
			$website = new WebsiteModel();	//实例化站点模型对象
			$site_info = $website->findByUid($usr_id);	//根据uid查找站点
			$site_id = $site_info['_id'].id;
			$site_id = $site['_id'].id;
		}
		return $site_id;
	}
	public function usr(){
		print_r($this->getUsr('email'));
	}
}