<<<<<<< HEAD
<?php
//+---------------------------------
//+ 素材数据模型对象
//+ Author:zjs
//+ Time:2012-12-03
//+---------------------------------
class MaterialModel extends MongoModel{
	/**
	* 添加新的素材信息
	* @param $arr 添加的数据格式
	*/
	public function newMater($arr){
		$arr['time'] = new MongoDate(strtotime(date('Y-m-d H:i:s',time())));//记录添加时间
		$arr['state'] = 1;//初始状态为启用
		$rs = $this->db->insert($arr);		//新增操作
		return $rs;
	}
	/**
	* 分页查找当前站点下的所有素材
	* @param $siteId 所属站点ID
	* @param $page 当前查询的页数
	* @param $limit 每页查询的条数
	* @param $type 筛选的类型
	* @param $size 
	*/
	public function selectBySiteIdWithPage($siteId,$type,$size=null,$page=1,$limit=10){
		$arr = array(
			'page' => $page,
			'limit' => $limit,
		);
		$arr['where'] = array(
			'site' => new MongoId($siteId),
			'state' => 1,
		);
		if($type != 'all'){
			$arr['where']['genre'] = $type;
		}
		if($size){
			$arr['where']['file.width'] = $size[0];
			$arr['where']['file.height'] = $size[1];
		}
		$rs = $this->order('_id desc')->select($arr);
		return $rs;
	}
	/**
	* 统计当前站点下的素材数量
	* $siteId 站点编号
	* $type 根据类型筛选
	* $size 根据素材尺寸筛选
	*/
	public function mCount($siteId,$type,$size=null){
		$arr['where'] = array('site' => new MongoId($siteId),'state' => 1);
		if($type != 'all'){
			$arr['where']['genre'] = $type;
		}
		if($size && $size != 'all'){
			$arr['where']['file.width'] = $size[0];
			$arr['where']['file.height'] = $size[1];
		}
		return $this->db->count($arr);
	}
	/**
	* 根据编号查找广告位信息
	* $seatId 广告位编号
	*/
	public function findById($mId){
		$arr['where'] = array('_id' => new MongoId($mId),'state' => 1);
		$rs = $this->find($arr);
		$rs['site'] = $rs['site']->__toString();//将mongo对象转为字符串
		return $rs;
	}
	/**
	* 修改素材的状态
	*/
	public function updateState($mId,$state){
		$arr['where'] = array('_id' => new MongoId($mId));
		$data = array(
			'state' => $state
		);
		return $this->db->update($data,$arr);
	}
	/**
	* 素材修改
	* $data 需要修改的数据
	* $mId 素材ID
	*/
	public function upMaterialById($data,$mId){
		$arr['where'] = array('_id' => new MongoId($mId));
		return $this->db->update($data,$arr);
	}
	/**
	* 获取素材不同尺寸列表
	*/
	public function groupSize($siteId){
		$keys = array('file.width' => true,'file.height' => true);//要分组的列
		$options = array('site' => new MongoId($siteId) , 'state' => 1 );//分组条件
		$initial = array('w' => 0,'h' => 0);//分组计算初始化的值
		// $reduce = 'function(obj,prev){prev.w = obj.file.width;prev.h = obj.file.height;}';//分组计算的方法
		$reduce = 'function(obj,prev){prev.w = 1;prev.h = 1;}';//分组计算的方法
		$rs =  $this->db->group($keys,$initial,$reduce,$options);
		$size_arr = $rs['retval'];
		$size_rs = array();//提取查询的结果集
		foreach ($size_arr as $k => $v) {
			$size_rs[$k] = array(
				'w' => $v['file.width'],
				'h' => $v['file.height']
			);
		}
		return $size_rs;
	}
=======
<?php
//+---------------------------------
//+ 素材数据模型对象
//+ Author:zjs
//+ Time:2012-12-03
//+---------------------------------
class MaterialModel extends MongoModel{
	/**
	* 添加新的素材信息
	* @param $arr 添加的数据格式
	*/
	public function newMater($arr){
		$arr['time'] = new MongoDate(strtotime(date('Y-m-d H:i:s',time())));//记录添加时间
		$arr['state'] = 1;//初始状态为启用
		$rs = $this->db->insert($arr);		//新增操作
		return $rs;
	}
	/**
	* 分页查找当前站点下的所有素材
	* @param $siteId 所属站点ID
	* @param $page 当前查询的页数
	* @param $limit 每页查询的条数
	* @param $type 筛选的类型
	* @param $size 
	*/
	public function selectBySiteIdWithPage($siteId,$type,$size=null,$page=1,$limit=10){
		$arr = array(
			'page' => $page,
			'limit' => $limit,
		);
		$arr['where']['name'] = array("exists" => 1);
		$arr['where'] = array(
			'site' => new MongoId($siteId),
			'state' => 1,
		);
		if($type != 'all'){
			$arr['where']['genre'] = $type;
		}
		if($size){
			$arr['where']['file.width'] = $size[0];
			$arr['where']['file.height'] = $size[1];
		}
		$rs = $this->order('_id desc')->select($arr);
		return $rs;
	}
	/**
	* 统计当前站点下的素材数量
	* $siteId 站点编号
	* $type 根据类型筛选
	* $size 根据素材尺寸筛选
	*/
	public function mCount($siteId,$type,$size=null){
		$arr['where'] = array('site' => new MongoId($siteId),'state' => 1);
		if($type != 'all'){
			$arr['where']['genre'] = $type;
		}
		if($size){
			$arr['where']['file.width'] = $size[0];
			$arr['where']['file.height'] = $size[1];
		}
		return $this->db->count($arr);
	}
	/**
	* 根据编号查找广告位信息
	* $seatId 广告位编号
	*/
	public function findById($mId){
		$arr['where'] = array('_id' => new MongoId($mId),'state' => 1);
		$rs = $this->find($arr);
		$rs['site'] = $rs['site']->__toString();//将mongo对象转为字符串
		return $rs;
	}
	/**
	* 修改素材的状态
	*/
	public function updateState($mId,$state){
		$arr['where'] = array('_id' => new MongoId($mId));
		$data = array(
			'state' => $state
		);
		return $this->db->update($data,$arr);
	}
	/**
	* 素材修改
	* $data 需要修改的数据
	* $mId 素材ID
	*/
	public function upMaterialById($data,$mId){
		$arr['where'] = array('_id' => new MongoId($mId));
		return $this->db->update($data,$arr);
	}
	/**
	* 获取素材不同尺寸列表
	*/
	public function groupSize($siteId){
		$keys = array('file.width' => true,'file.height' => true);//要分组的列
		$options = array('site' => new MongoId($siteId));//分组条件
		$initial = array('w' => 0,'h' => 0);//分组计算初始化的值
		$reduce = 'function(obj,prev){prev.w = obj.file.width;prev.h = obj.file.height;}';//分组计算的方法
		$rs =  $this->db->group($keys,$initial,$reduce,$options);
		$size_arr = $rs['retval'];
		$size_rs = array();//提取查询的结果集
		foreach ($size_arr as $k => $v) {
			$size_rs[$k] = array(
				'w' => $v['w'],
				'h' => $v['h']
			);
		}
		return $size_rs;
	}
	/**
	* 查找素材的文件
	*/
	public function findFileById($mId){
		$arr['where'] = array('_id' => new MongoId($mId),'state' => 1);
		$arr['field'] = array('file.resUrl');
		return $this->find($arr);
	}
>>>>>>> 素材相关
}