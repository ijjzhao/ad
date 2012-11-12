<?php
//+---------------------------------
//+ 站点模型
//+---------------------------------
class WebsiteModel extends MongoModel{

	/**
	* 根据uid查找所属用户的站点
	* $uid 用户编号
	*/
	public function selectByUid($uid){
		$arr['where'] = array(
			'uid' => new MongoId($uid)
		);
		return $this->db->select($arr);//查找多条数据
	}
	/**
	* 根据uid查找所属用户的站点（现在的系统，只支持单个站点，用这个方法，只查询一条数据就可）
	* $uid 用户编号
	*/
	public function findByUid($uid){
		$arr['where'] = array(
			'uid' => new MongoId($uid)
		);
		return $this->db->find($arr);
	}
	/**
	* 查找当前用户的所属站点的编号
	*/
	public function getSiteIdByUId($uid){
		$arr['where'] = array(
			'uid' => new MongoId($uid)
		);
		$arr['field'] = array('_id');//指定查找的字段
		return $this->db->find($arr);
	}
	/**
	* 新增频道
	* $chnName 频道的名称
	* $desc 频道备注
	*/
	public function addChannel($chnName,$desc){
		
	}
}