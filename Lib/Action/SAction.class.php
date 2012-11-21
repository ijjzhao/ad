<?php
//+----------------------------------------------------------------
//+ 独立类，不继承任何自定义的基类，主要对未登录前的页面显示控制
//+ Time:2012-11-09 18:55 
//+ Author: zjs
//+----------------------------------------------------------------

class SAction extends Action{
	private $usr_key = 'adusr';//用户信息存在session中的key
	/**
	* 构造函数 
	* Time:2012-11-09 19:01
	* Author: zjs
	*/
	public function __construct(){
		parent::__construct();
		if(session('?'.$this->usr_key)){	
			$this->showIndex();
		}
	}
	/**
	* 显示登录页面
	* Time:2012-11-09 19:10
	* Author: zjs
	*/
	public function lgn(){
		$this->display('User:login');
	}
	/*
	* 登录请求处理
	* Time:2012-11-09 19:22
	* Author: zjs
	*/
	public function login(){
		$email = 'shiba@da.com';	//登录邮箱
		$psd = md5('111111');		//登录密码
		$user = new UserModel();	//实例化用户模型
		$u_info = $user->login($email,$psd);	//登录验证
		session($this->usr_key,$u_info);	//将登录信息存放到session
		$this->showIndex();
	}
	/**
	* 显示注册页面
	* Time:2012-11-09 19:10
	* Author: zjs
	*/
	public function reg(){
		$this->display('User:register');
	}
	/**
	* 跳转到首页
	* Time:2012-11-09 19:26
	* Author: zjs
	*/
	private function showIndex(){
		$this->redirect('index/index');//重定向到首页
	}
}