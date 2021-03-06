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
		if(is_array($size)){//根据尺寸筛选
			$arr['where']['file.width'] = $size[0];
			$arr['where']['file.height'] = $size[1];
		}else if(is_string($size) && $size == 'np'){//筛选没有尺寸的素材
			$arr['where']['file.width'] = array('exists' ,0);
		}
		// print_r($arr);
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
		if(is_array($size)){//根据尺寸筛选
			$arr['where']['file.width'] = $size[0];
			$arr['where']['file.height'] = $size[1];
		}else if(is_string($size) && $size == 'np'){//筛选没有尺寸的素材
			$arr['where']['file.width'] = array('exists' ,0);
		}
		// print_r($arr); 
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
	* 广告部分需要用到的素材信息
	*  @param $mId 素材ID
	*/
	public function findToAdById($mId){
		$arr['where'] = array('_id' => new MongoId($mId),'state' => 1);
		$arr['field'] = array('name','link','file','genre','code');//指定需要查找的字段
		return $this->find($arr);
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
		$initial = array('count' => 0);//分组计算初始化的值
		$reduce = 'function(obj,prev){prev.count += 1;}';//分组计算的方法
		$rs =  $this->db->group($keys,$initial,$reduce,$options);
		$size_arr = $rs['retval'];
		//将结果集进行冒泡排序
		$count_arr = count($size_arr);
		for ($i=0; $i < $count_arr; $i++) {
			for ($j=0; $j < $count_arr; $j++) {
				$temp = $size_arr[$i];
				$i_cnt = $temp['count'];
				$j_cnt = $size_arr[$j]['count'];
				if($i_cnt > $j_cnt){
					$temp = $size_arr[$j];
					$size_arr[$j] = $size_arr[$i];
					$size_arr[$i] = $temp;
				}
			}
		}
		$size_rs = array();//提取查询的结果集
		foreach ($size_arr as $k => $v) {
			$width = $v['file.width'];
			$height = $v['file.height'];
			$count =  $v['count'];
			if($width && $height && $count){
				$size_rs[$k] = array('w' => $width,'h' => $height,'c' => $count);
			}
		}
		return $size_rs;
	}
}