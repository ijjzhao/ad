<?php
//+---------------------------------
//+ 用户模型
//+---------------------------------
class UserModel extends MongoModel{
	/**
	* 登录验证
	* $email 登录邮箱
	* $pad 登录密码
	*/
	public function login($email,$psd){
		$arr['where'] = array(
			'email' => $email,
			'psd' => $psd,
			'state' => 1
		);//筛选条件
		$arr['field'] = array('email','name','url');//指定要获取的字段
		return $this->db->find($arr);
	}
}