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
	* $site_id 所属的站点
	* $chnName 频道的名称
	* $desc 频道备注
	*/
	public function addChannel($site_id,$chnName,$desc){
		$arr['where'] = array(
			'_id' => new MongoId($site_id),
		);
		$chn_info = array(
			'chnName' => $chnName,
			'state' => 1,
			'desc' => $desc
		);
		$data = array(
			'channel' => array('addToSet',$chn_info)
		);
		return $this->db->update($data,$arr);
	}
	/**
	* 删除指定站点下的频道
	* $site_id 站点编号
	* $chnName 要删除的频道
	*/
	public function delChannel($site_id,$chnName){
		$arr['where'] = array(
			'_id' => new MongoId($site_id),
		);
		$chn_info = array('chnName' => $chnName);
		$data = array(
			'channel' => array('pull',$chn_info)
		);
		return $this->db->update($data,$arr);
	}
	/**
	* 查找当前站点下所有的频道
	* $site_id 站点编号
	*/
	public function selectChannel($site_id){
		$arr['where'] = array(
			'_id' => new MongoId($site_id),
			'channel.state' => 1
		);
		$arr['field'] = array('channel','channel.chnName','channel.desc');
		return $this->db->select($arr);
	}
}