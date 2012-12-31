<?php
/**
 * 客户信息模型
 * Time: 2012/12/24
 * author: wzx
 */
	class ClientModel extends MongoModel{
		/**
		 * [addCli 添加客户信息]
		 * @param [type] $arr [客户信息数组]
		 */
		function addCli($arr){
			return $this->db->insert($arr);
		}
		/**
		 * [delCli 删除客户信息]
		 * @param  [type] $c_id [客户id]
		 * @return [type]       [bool]
		 * 
		 */
		function delCli($c_id){
			$arr['where'] = array('_id' => new MongoId($c_id));
			return $this->db->delete($arr);
		}
		/**
		 * [upCli 修改客户信息]
		 * @param  [type] $arr  [新客户信息]
		 * @param  [type] $c_id [客户id]
		 * @return [type]       [bool]
		 */
		function upCli($arr,$c_id){
			$arr['where'] = array('_id'=> new MongoId($c_id));
			return $this->db->update($arr);
		}
		/**
		 * [selCli 查看客户列表]
		 * @return [type] [array]
		 */
		function selCli(){
			return $this->db->select();
		}
		/**
		 * [selById 查看单条客户信息]
		 * @param  [type] $c_id [根据id查看]
		 * @return [type]       [array]
		 */
		function selById($c_id){
			$arr['where'] = array('_id' =>new MongoId($c_id));
			return $this->find($arr);
		}

	}
?>