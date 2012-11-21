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
		if($this->isGet()){
			$page = $_GET['_URL_'][2];//获取查询的页数
			$chn = $_GET['_URL_'][3];//根据频道筛选;
			$chn = $chn == 'all' ? null : $chn;
			$put = $_GET['_URL_'][4];//根据投放状态筛选
			$put = $put == 'all' ? null : $put;
			if(is_numeric($page)){//是否是数字
				$return_arr = array('limit'=> 5,'page'=>$page);			//定义内容输出数组
				$site = $this->getWebSite();	//获取站点信息				
				if($site){	//验证是否有站点数据
					$chnnel_name_arr = array();						//频道名称列表
					foreach ($site['channel'] as $k => $v) {
						$chnnel_name = $v['chnName'];				//获取当前频道的名称
						array_push($chnnel_name_arr,$chnnel_name);	//将频道名称添加到频道名称列表中
					}
					$return_arr['chn'] = $chnnel_name_arr;		//设置要输出的频道信息
					//获取当前站点下的所有广告位
					$adseat = new AdseatModel();	//实例化广告位模型对象
					$seat_arr = $adseat->selectWithPage($site['_id'],$page,$return_arr['limit'],$chn,$put);
					$seat_info_arr = array();
					foreach ($seat_arr as $k => $v) {				
						if(!$v['auxSize']['width'] || !$v['auxSize']['height']){
							unset($v['auxSize']);//移出不需要的元素
						}
						array_push($seat_info_arr, $v);
					}
					$return_arr['sea'] = $seat_info_arr;			//设置要输出的频道信息
				}
				$this->ajaxReturn($return_arr,'广告位列表',1);
			}else{
				$this->ajaxReturn('','参数错误',0);
			}
		}else{
			$this->ajaxReturn('','请求错误',0);
		}
	}
	/**
	* 新增广告位
	*/
	public function add(){
		if($this->isPost()){//获取提交才数据
			if(!empty($_POST['ana']) && !empty($_POST['spe']) && !empty($_POST['pri']) && !empty($_POST['des'])){//验证必须提交的数据是否存在
				$msg_licit = true;//标识信息是否符合规则
				if(!is_numeric($_POST['spe'])) $msg_licit = false;
				$arr = array(
					'name' => $_POST['ana'],
					'shape' => $_POST['spe'],
					'priSize' => explode('x',$_POST['pri']),
					'website' => new MongoId($this->getWebSiteId())
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
				if($rs['ok']){
					$this->ajaxReturn($rs['id'],'添加成功',1);
				}else{
					$this->ajaxReturn('','添加失败',0);
				}
			}else{
				$this->ajaxReturn('','信息不完整',0);
			}
		}else{
			$this->ajaxReturn('','请求错误',0);
		}
	}
	/**
	* 修改广告位（客户端由表单提交）(修改有些关联项需要处理，这里和添加代码有点冗余需修改)
	*/
	public function upd(){
		if($this->isPost()){
			if(!empty($_POST['id']) && !empty($_POST['ana']) && !empty($_POST['pri']) && !empty($_POST['des'])){//获取id
				$seat_id = $_POST['id'];
				$arr = array(
					'name' => $_POST['ana'],
					'priSize' => explode('x',$_POST['pri']),
					'website' => new MongoId($this->getWebSiteId())
				);//定义存储的内容
				$arr['desc'] = $_POST['des'] == '备注' ? '' : $_POST['des'];
				$arr['auxSize'] = empty($_POST['aux']) ? 0 : explode('x', $_POST['aux']);
				$arr['chnName'] = empty($_POST['chn']) ? 0 : $_POST['chn'];
				$arr['isPush'] = empty($_POST['psh']) ? 'off' : 'on';
				$arr['isScroll'] = empty($_POST['sll']) ? 'off' : 'on';
				$arr['reTime'] = empty($_POST['stp']) ? -1 : $_POST['stp'];
				/*广告位形式有关联，暂时不修改
				$arr['layout']['orientation'] = empty($_POST['ore']) ? 0 : $_POST['ore'];
				$arr['layout']['gavity'] = empty($_POST['gty']) ? 0 : $_POST['gty'];
				$arr['layout']['vertical'] = empty($_POST['ver']) ? 0 : $_POST['ver'];
				$arr['layout']['horizontal'] = empty($_POST['hor']) ? 0 : $_POST['hor'];*/
				//实例化广告位模型对象
				$m_adseat = new AdseatModel();
				$rs = $m_adseat->upSeatById($arr,$seat_id);
				if($rs){
					$this->ajaxReturn('','修改成功',1);
				}else{
					$this->ajaxReturn('','修改失败',1);	
				}
			}else{
				$this->ajaxReturn('','信息不全',0);
			}
		}
	}
	/**
	* 根据编号获取站点的详细信息
	*/
	public function inf(){
		if($this->isGet()){
			$seat_id = $_GET['_URL_'][2];//获取广告位ID
			if($seat_id){
				$m_adseat = new AdseatModel();//实例化广告位模型对象
				$seat_info = $m_adseat->findById($seat_id);
				$this->ajaxReturn($seat_info,'广告位信息',1);
			}
		}
	}
	/**
	* 删除广告位
	*/
	public function del(){
		if($this->isGet()){
			$seat_id = $_GET['_URL_'][2];//获取广告位ID
			if($seat_id){
				$m_adseat = new AdseatModel();//实例化广告位模型对象
				$rs = $m_adseat->delById($site_id);
				if($rs){
					$this->ajaxReturn('','删除成功',1);
				}else{
					$this->ajaxReturn('','删除失败',0);
				}
			}else{
				$this->ajaxReturn('','No Id',0);
			}
		}
	}
	/**
	*根据条件统计当前站点下所有的广告位数量
	*/
	public function cnt(){
		if($this->isGet()){
			$chn = $_GET['_URL_'][2];//根据频道筛选;
			$chn = $chn == 'all' ? null : $chn;
			$put = $_GET['_URL_'][3];//根据投放状态筛选
			$put = $put == 'all' ? null : $put;
			$m_adseat = new AdseatModel();
			$op = array();
			// if($put != null && $put == 0){//查询空闲的
			// 	$op['adnum'] = 0;
			// }else if($put == 1){//查询正在投放的
			// 	$op['adnum'] = array('gt',0);
			// }
			if($chn){//筛选频道
				$op['chnName'] = $chn;
			}
			$count = $m_adseat->adcount($this->getWebSiteId(),$op);
			$this->ajaxReturn($count,'广告位数量',1);
		}
	}
	/**
	* 获取当前用户的站点（单个）
	*/
	private function getWebSite(){
		$usr_id = $this->getUsr('id');		//获取用户的编号
		$website = new WebsiteModel();	//实例化站点模型对象
		$site_info = $website->findByUid($usr_id);	//根据uid查找站点		
		$site_id = $site_info['_id'];
		$this->siteToSession($site_id);
		return $site_info;
	}
}