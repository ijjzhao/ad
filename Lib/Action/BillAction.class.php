<?php
//+----------------------------------------------------------------
//+ 广告逻辑处理控制器
//+ Time:2012-12-20 14:21
//+ Author: zjs
//+----------------------------------------------------------------
class BillAction extends SspAction{
	/**
	* 这里处理广告的显示
	*/
	public function index(){
		if($this->isGet()){
			$seat_id = trim($_GET['_URL_'][2]);//获取广告位的编号
			$bill_model = new BillModel();
			$rs = $bill_model->showById($seat_id);
			print_r($rs);
		}
		// echo 'Bill';
		// $d = '2012-12-31';
		// var_dump($d);
		// var_dump(strtotime($d));
		// $ar = array("50c1c3a0f8894e594a0d0000",'50c1c3a0f8894e594a0d0002','50c1c3a0f8894e594a0d0003');
		
		// $ar = array(
		// 		array(1,20), array(1,21),array(1,22), 
		// 		array(2,20), array(2,21),array(2,22), 
		// 		array(3,10), array(3,11),array(3,12),array(3,13), array(3,14),array(3,15),array(3,16),
		// 		array(4,10), array(4,11),array(4,12),array(4,13), array(4,14),array(4,15),array(4,16)
		// 	);
		// $json_str = json_encode($ar);
		// var_dump($json_str);
		// print_r(json_decode($json_str));
	}
	/**
	* 新增广告
	*/
	public function newd(){
	// 	$mts = json_encode(array("50c1c323f8894ee0be040000","50c1c33ff8894e474f000000","50c1c3a0f8894e594a0d0000"));
		// $put = json_encode(
		// 	// array('1355932800')
		// 	array('1355932800' ,'1356883200','1355932800' ,'1356105600','1356364800' ,'1356883200')
		// );
		// print_r($put);
	// 	$rgn = json_encode(
	// 		array(
	// 			array('北京',1),
	// 			array('四川','成都市'),array('四川','德阳市')
	// 		)
	// 	);
	// 	$sys = json_encode(
	// 		array(
	// 			'w','m','l'
	// 		)
	// 	);
	// 	$_POST = array(
	// 		//1、广告名称
	// 		'ana' => '呵呵',
	// 		'esc' => '这个广告会卖萌',
	// 		'odr' => '50a1f3b3f8894e6217000000',
	// 		'pty' => 1,
	// 		//2、广告位
	// 		'sat' => '509ca88ef8894e7585000000',
	// 		//3、广告素材
	// 		'mts' => $mts,
			// 'pts' => '509ca88ef8894e7585000000'
	// 		//4、排期
	// 		'pyp' => 'l',
	// 		'put' => $put,
	// 		//5、计费
	// 		'typ' => 'm', 
	// 		'pce' => '1.5',
	// 		'nbr' => '150',
	// 		'lmt' => '10',
	// 		//6、定向控件
	// 		'sys' => $sys,
	// 		'sow' => 1,
	// 		'rgn' => $rgn,
	// 		'wen' => '[[1,20],[1,21],[1,22],[2,20],[2,21],[2,22],[3,10],[3,11],[3,12],[3,13],[3,14],[3,15],[3,16],[4,10],[4,11],[4,12],[4,13],[4,14],[4,15],[4,16]]',
	// 		// 'wen' => '[["1355932800","1356883200"],["1355932800" ,"1356105600"]]'
	// 	);
	// 	print_r($_POST);
		$exist_key_arr = array('ana','sat');//必须添加的Key
		if($this->isPost() && $this->postKeyExist($exist_key_arr)){
			$read_arr = $this->readArray($this->biilKayArr(),$_POST);//读取数据，并以指定的格式返回
			$read_arr['put'] = $this->putRead($_POST['pyp'],$_POST['put']);//处理排期的格式信息
			$read_arr['mater'] = $this->materRead($_POST['mts']);//处理素材信息
			$read_arr['pair'] = $this->pairRead($_POST['pts']);//处理副画面素材信息
			$read_arr['dir']['whileDir'] = $this->wenRead($_POST['wen']);//处理时间定向
			$rgn_arr = $this->rgnRead($_POST['rgn']);//获得地域的数组
			$read_arr['dir']['regionDir'] = array('isShow' => $_POST['sow'],'reg' => $rgn_arr);
			$read_arr['dir']['system'] = $this->sysRead($_POST['sys']);//设置平台的定向
			// 实例化广告模型对象
			$bill_model = new BillModel();
			$rs = $bill_model->newMater($read_arr);//添加新的广告
			if($rs['ok']){
				$this->ajaxReturn($rs['id'],'添加成功',1);
			}else{
				$this->ajaxReturn(null,'添加失败',0);
			}
		}else{
			$this->ajaxReturn(null,'数据不完整',0);
		}
	}
	/**
	* 定义存储数据的格式
	*/
	private function biilKayArr(){
		$key_arr = array(
			//1、广告信息
			'name' => 'ana',//广告名称
			'desc' => 'esc',//备注
			'order' => 'odr',//订单
			'priority' => 'pty',//权重，优先级
			//2、广告位
			'seat' => 'sat',
			//3、素材
			//4、排期
			//5、计费
			'billing' => array(
				'type' => 'typ',
				'price' => 'pce',
				'number' => 'nbr',
				'limit' => 'lmt',
			),
			//6、定向
		);
		return $key_arr;
	}
	/**
	* 处理素材的数据
	* @param $mater 素材id json数据
	*/
	private function materRead($mater){
		$mater_arr = json_decode($mater);//获得广告ID数组
		$mater_arr_count = count($mater_arr);//获取数组长度
		$mater_model_arr = array();//素材模型数组
		$mater_model = new MaterialModel();//实例化素材模型对象
		for ($i=0; $i < $mater_arr_count; $i++) {
			$mater_model_arr[$i] = $mater_model->findToAdById($mater_arr[$i][0]);
			$mater_model_arr[$i]['priority'] = $mater_arr[$i][1];
		}
		return $mater_model_arr;
	}
	/*
	* 副画面素材尺寸
	*/
	private function pairRead($pair){
		if($pair){
			$mater_model = new MaterialModel();
			$mater_info = $mater_model->findToAdById($pair);
			return $mater_info;
		}else{
			return null;
		}
	}
	/**
	* 处理排期的的数据
	* @param $put 排除的json数据
	* @param $pyp 排期的类型（l 连续排期，d 断续排期）
	*/
	private function putRead($pyp,$put){
		$put_arr = json_decode($put);//将json数据转为数组
		$put_info = array('pyp' => $pyp);
		if($pyp == 'l'){//连续排期
			$startTime = $put_arr[0];//获得开始排期的时间
			$stopTime = $put_arr[1];//获取结束排期的时间
			$startTime = empty($startTime) ? $this->getTimeInfo() : $startTime;
			// $stopTime = empty($stopTime) ? $this->getTimeInfo($startTime,60*60*24*365*100,true) : $stopTime;
			// $put_info['time'] = array(new MongoDate($startTime),new MongoDate($stopTime));
			if(empty($stopTime)){//没有结束时间时，不添加到里面
				$put_info['time'] = array(new MongoDate($startTime));
			}else{
				$put_info['time'] = array(new MongoDate($startTime),new MongoDate($stopTime));
			}
		}else if($pyp == 'p'){//断续排期
			foreach ($put_arr as $k => $v) {
				$put_info['time'][$k] = new MongoDate($v);
			}
		}		
		return $put_info;
	}
	/**
	* 时间定向的处理
	* @param $wen 时间定向的josn数据
	*/
	private function wenRead($wen){
		$wen_arr = json_decode($wen);//将json数据转为数组
		if($wen_arr != 1){
			for($i = 0; $i < 7; $i++){
				for($j = 0; $j < 24; $j++){
					$day[$j] = 0;
				}
				$week[$i] = $day;
			}
			//设置选择的排期时间
			foreach ($wen_arr as $v) {
				$week[$v[0]][$v[1]] = 1;
			}
			return $week;
		}else{
			return 1;
		}
	}
	/**
	* 地域定向处理
	* @param $rgn 地域投放的json数据
	*/
	private function rgnRead($rgn){
		$rgn_arr = json_decode($rgn);//将json数据转为数组
		return $rgn_arr;
	}
	/**
	* 指定投放的平台
	*
	*/
	private function sysRead($sys){
		$sys_arr = json_decode($sys);//将json数据转为数组
		return $sys_arr;
	}
	/**
	* 获取当前用户站点下的广告列表
	*/
	public function lst(){
		if($this->isGet()){
			$page = trim($_GET['_URL_'][2]);//获取查询的页数
			$page = is_numeric($page) ? $page : 1;
			$limit = 5;//每页的条数
			$sid_arr = $this->getSeatIdArr();//存放广告为id的数组
			//获得当前时间,的时间戳
			$now_time = $this->getTimeInfo(null,0,true);
			//根据广告位ID查找广告
			$bill_model = new BillModel();//实例化广告模型数据
			$bill_rs = $bill_model->selectBySiteIdWithPage($sid_arr,$page,$limit,array('name','desc','order','put'),$now_time);
			$return_arr = array();//最终返回给客服端的数据
			$index = 0;
			foreach ($bill_rs as $k => $v) {
				$put = $v['put'];//获取排期的时间
				$put_cnt = count($put['time']);
				$startTime = $put['time'][0]->sec;//获取开始排期的时间
				if($now_time < $startTime){//当前时间小于开始投放的时间，表示为 待投放状态
					$v['state'] = 1;//'待投放';
				}else if($put_cnt > 1){
					$stopTime = $put['time'][$put_cnt - 1]->sec;
					if($now_time >= $startTime && $now_time < $stopTime){
						$v['state'] = 2;//"投放中";
					}else{
						$v['state'] = 3;//"投放完成";
					}
				}else if($now_time >= $startTime){
					$v['state'] = 2;
				}
				$return_arr[$index] = $v;
				$index++;
			}						
			$return = array(
				'sea' => $return_arr,
				'page' => $page,
				'limit' => $limit
			);
			$this->ajaxReturn($return,'广告列表',1);
		}
	}
	/**
	* 根据条件，统计条数
	*/
	public function cnt(){
		$sid_arr = $this->getSeatIdArr();//存放广告为id的数组
		$bill_model = new BillModel();//实例化广告模型数据
		$return_arr = $bill_model->countBySiteId($sid_arr);
		$this->ajaxReturn($return_arr,'广告条数',1);
	}
	/**
	*  获取当前站点下，所有的广告位编号
	*/
	private function getSeatIdArr(){
		$seat_model = new AdseatModel();
		$seat_id_arr = $seat_model->selectIdBySid($this->getWebSiteId());//获取当前站点下所有的广告位ID
		$index = 0;
		$sid_arr = array();//存放广告为id的数组
		foreach ($seat_id_arr as $v) {//遍历提取id
			$sid_arr[$index] = $v['_id'];
			$index ++;
		}
		return $sid_arr;
	}
	/**
	* 根据广告的ID获取广告信息 
	*/
	public function inf(){
		if($this->isGet()){
			$ad_id = trim($_GET['_URL_'][2]);//获得广告的编号
			$bill_model = new BillModel();
			$rs = $bill_model->findById($ad_id);
			// print_r($rs);
			$this->ajaxReturn($rs,'广告详情',1);
		}
	}
	/**
	* 修改广告的信息
	*/
	public function upd(){
		$exist_key_arr = array('aid','name','order','seat');//必须添加的Key
		if($this->isPost() && $this->postKeyExist($exist_key_arr)){

			$ad_id = trim($_POST['aid']);//得到广告的编号
			$read_arr = $this->readArrayExist($this->biilKayArr(),$_POST);//读取数据，并以指定的格式返回
			if(!empty($_POST['put'])){//验证是否对排期进行修改
				$read_arr['put'] = $this->putRead($_POST['pyp'],$_POST['put']);//处理排期的格式信息
			}
			if(!empty($_POST['mts'])){
				$read_arr['mater'] = $this->materRead($_POST['mts']);//处理素材信息
			}
			if(!empty($_POST['wen'])){
				$read_arr['dir.whileDir'] = $this->wenRead($_POST['wen']);//处理时间定向
			}
			if(!empty($_POST['sow']) && !empty($_POST['rgn'])){
				$rgn_arr = $this->rgnRead($_POST['rgn']);//获得地域的数组
				$read_arr['dir.regionDir'] = array('isShow' => $_POST['sow'],'reg' => $rgn_arr);
			}
			if(!empty($_POST['sys'])){
				$read_arr['dir.system'] = $this->sysRead($_POST['sys']);//设置平台的定向
			}
			//实例化广告模型对象
			$bill_model = new BillModel();
			$rs = $bill_model->billUpdate($ad_id,$read_arr);
			if($rs){
				$this->ajaxReturn(null,'修改成功',1);
			}else{
				$this->ajaxReturn(null,'修改失败',0);
			}

		}
	}
	/**
	* 根据广告编号删除广告(这里的删除只是改变广告的状态)
	*/
	public function del(){
		if($this->isGet()){
			$ad_id = trim($_GET['_URL_'][2]);//获取查询的页数
			$bill_model = new BillModel();
			$rs = $bill_model->updateState($ad_id,'d');
			if($rs){
				$this->ajaxReturn(null,'删除成功',1);
			}else{
				$this->ajaxReturn(null,'删除失败',0);
			}
		}
	}
}