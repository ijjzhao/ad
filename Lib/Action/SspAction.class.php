<?php
//+----------------------------------------------------------------
//+ 自定义，ssp部分使用到的基类
//+ Time:2012-11-09 18:06  
//+ Author: zjs
//+----------------------------------------------------------------
class SspAction extends Action{
	private $usr_key = 'adusr';//用户信息存在session中的key
	/**
	* 构造函数 
	* Time:2012-11-09 18:09 
	* Author: zjs
	*/
	public function __construct(){
		parent::__construct();
		$this->is_login();
	}
	/**
	* 验证用户是否已经登录了
	* Time:2012-11-09 18:32
	* Author: zjs
	*/
	protected function is_login(){
		if(!session('?'.$this->usr_key)){
			$this->redirect('S/lgn');//重定向到登录
		}
	}
	/**
	* 根据key获取登录用户的信息
	* Time:2012-11-09 19:49
	* Author: zjs
	*/
	protected function getUsr($key='all'){
		$usr_info = session($this->usr_key);	//获取session中登录用户的信息
		if($key == 'all'){
			return $usr_info;
		}else if($key == 'id'){
			return $usr_info['_id'].id;
		}else{
			return $usr_info[$key];
		}
	}
}