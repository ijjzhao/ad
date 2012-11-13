<?php
//+--------------------------------
//+ 广告位模型
//+--------------------------------
class AdseatModel extends MongoModel{
	/**
	* 根据站点id查找广告位
	* $siteId 站点编号
	*/
	public function selectBySiteid($siteId){
		$arr['where'] = array(
			'website' => new MongoId($siteId)
		);
		$arr['field'] = array('name','shape','priSize','auxSize');//指定查找的字段
		return $this->db->select($arr);
	}
	/**
	* 新增广告位
	* $arr 新增广告位的信息数组
	*/
	public function addNewSeat($arr){
		$d = date('Y-m-d H:i:s',time());				//获取当前时间
		$arr['time'] = new MongoDate(strtotime($d));	//转为Mongo对象时间
		$arr['state'] = 1;
		$rs = $this->db->insert($arr);		//新增操作
		return $rs;
	}

}