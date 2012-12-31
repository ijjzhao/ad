<?php
/**
 * 订单模型
 * Date：2012、12、20
 * Aurth：wzx
 */
class OrderModel extends MongoModel{
	/**
	 *新增订单
	 *$ar 新增信息
	 */
	function newOrder($ar){
		$time = date("y/m/d H:i:s");
		$ar['creatTime'] = new MongoDate(strtotime($time));
		return $this->db->insert($ar);
	}
	/**
	 * 获取订单列表
	 * 全部信息
	 */
	function selOrder(){
		$ar['field'] = array('_id','name','site');
		return $this->select($ar);
	}
	/**
	 * [selById 根据订单id获取订单信息]
	 * @param  [type] $o_id [订单id]
	 * @return [type]       [符合要求的信息]
	 */
	function selById($o_id){
		$ar['where'] = array('_id' => new MongoId($o_id));
		return $this->find($ar);
	}
	/**
	 * 删除订单
	 * 全部
	 */
	function delOrders($oid){
		$ar['where'] = array('_id' =>new MongoId($oid));
		return $this->delete($ar);
	}
	/**
	 * [upOrders description]
	 * 订单信息修改
	 * @param  [type] $ar [description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function upOrders($ar,$id){
		$a['where'] = array('_id' =>new MongoId($id));
		return $this->db->update($ar,$a);
	}

}
?>