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
	*/
	public function selectBySiteIdWithPage($siteId,$page=1,$limit=10){
		$arr = array(
			'page' => $page,
			'limit' => $limit,
		);
		$arr['where'] = array(
			'site' => new MongoId($siteId)
		);
		return $this->db->select($arr);
	}
	/**
	* 统计当前站点下的素材数量
	* $siteId 站点编号
	*/
	public function mCount($siteId){
		$arr['where'] = array('site' => new MongoId($siteId));
		return $this->db->count($arr);
	}
}