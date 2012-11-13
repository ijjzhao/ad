<?php
//+----------------------------------------------------------------
//+ 自定义，ssp部分使用到的基类
//+ Time:2012-11-09 18:06  
//+ Author: zjs
//+----------------------------------------------------------------
class SspAction extends Action{
	private $usr_key = 'adusr';//用户信息存在session中的key
	private $site_key = 'adsite';//用户所属的站点信息存储到sessoin中
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
			return $usr_info['_id'];
		}else{
			return $usr_info[$key];
		}
	}

	/**
	* 获取当前用户站点的编号
	*/
	protected function getWebSiteId(){
		$site_id = '';		
		if(session('?'.$this->site_key)){
			$site_id = session($this->site_key); 		
		}else{
			$usr_id = $this->getUsr('id');		//获取用户的编号
			$website = new WebsiteModel();	//实例化站点模型对象
			$site_info = $website->getSiteIdByUId($usr_id);	//根据uid查找站点
			$site_id = $site_info['_id'];
			$this->siteToSession($site_id);
		}
		return $site_id;
	}
	/**
	* 保存站点信息到session中
	* Time:2012-11-13 17:52
	* Author:zjs
	*/
	protected function siteToSession($site){
		session($this->site_key,$site);
	}
    /**
    * 退出
    * Time:2012-11-09 19:37
	* Author: zjs
    */
    public function q(){
    	session($this->usr_key,null);
    }
}