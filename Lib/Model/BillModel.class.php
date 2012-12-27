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
	public function selectBySiteIdWithPage($seatArr,$page=1,$limit=10){
		$arr = array(
			'page' => $page,
			'limit' => $limit,
		);
		$arr['where'] = array(
			'seat' => array('in',$seatArr)
		);
		$rs = $this->select($arr);
		return $rs;
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
}