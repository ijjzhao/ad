<?php
//+---------------------------------
//+ 广告数据模型对象
//+ Author:zjs
//+ Time:2012-12-19
//+---------------------------------
class BillModel extends MongoModel{

	/**
	* 添加新的广告
	* @param $arr 添加的数据格式
	*/
	public function newMater($arr){
		$d = new MongoDate(strtotime(date('Y-m-d H:i:s',time())));
		$arr['time'] = new MongoDate(strtotime(date('Y-m-d H:i:s',time())));//记录添加时间
		$arr['state'] = 'w';//初始设置待投放
		$rs = $this->db->insert($arr);//新增操作
		return $rs;
	}
	/**
	* 查找对应广告位下的广告
	* @param $seatArr 广告位id数组
	* @param $page 当前查询的页数
	* @param $limit 每页查询的条数
	*/
	public function selectBySiteIdWithPage($seatArr,$page=1,$limit=10,$field = null,$time = null){
		$arr = array(
			'page' => $page,
			'limit' => $limit,
		);
		$arr['where'] = array(
			'seat' => array('in',$seatArr)
		);
		if($field){
			$arr['field'] = $field;
		}
		if($time){
			$arr['where']['put.time']  = array('lt', new MongoDate($time));
		}
		// print_r($arr);
		$rs = $this->select($arr);
		// print_r($rs);
		return $rs;
	}
	/**
	* 查找对应广告位下的广告
	* @param $seatArr 广告位id数组
	*/
	public function countBySiteId($seatArr){
		$arr['where'] = array(
			'seat' => array('in',$seatArr)
		);
		return $this->db->count($arr);
	}
	/**
	* 根据编号查找广告的详细信息
	* @param $aId 广告的ID
	*/
	public function findById($aId){
		$arr['where'] = array('_id' => new MongoId($aId));
		return $this->find($arr);
	}
	/**
	* 修改广告的信息
	* @param $sId 广告的编号
	* @param $data 要修改成的内容
	*/
	public function billUpdate($aId,$data){
		$arr['where'] = array('_id' => new MongoId($aId));
		return $this->db->update($data,$arr);
	}
	/**
	* 改变状态
	* @param $aId 广告的编号
	* @param $state 改为状态
	*/
	public function updateState($aId,$state){
		$arr['where'] = array('_id' => new MongoId($aId));
		$data = array(
			'state' => $state
		);
		return $this->db->update($data,$arr);
	}
	/**
	* 根据广告位编号，显示需要显示的广告(这里在前端显示时用到)
	* @param $seatId
	*/
	public function showById($seatId){
		$arr['where'] = array(
			'seat' => $seatId,
		);
		return $this->select($arr);
	}
}