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
		if(session('?'.$this->site_key)){
			$site_id = session($this->site_key); 
		}else{
			$usr_id = $this->getUsr('id');		//获取用户的编号
			$site_info = new WebsiteModel();
			$website = new WebsiteModel();	//实例化站点模型对象
			$site_info = $website->getSiteIdByUId($usr_id);	//根据uid查找站点
			$site_id = $site_info['_id'];
			session($this->site_key,$site_id);
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
	* 验证post是否有指定的key
	* @param $keys 需要验证的key
	*/
	protected function postKeyExist($keys){
		$is_exist = true;//是否存在的标识
		if(is_array($keys)){
			foreach ($keys as $v) {				
				if(empty($_POST[$v])){
					$is_exist = false;
					break;
				}
			}
		}else{
			$is_exist = !empty($_POST[$keys]);
		}
		return $is_exist;
	}
	/**
	* 读取指定数组中，指定key的值
	* @param $keys 读取的值和存放的值
	* @param $arr 需要读取的数组
	* @return 返回$keys格式的新数组
	*/
	protected function readArray($keys,$arr){
		foreach ($keys as $k => $v) {			
			if(is_array($v)){
				$read_arr[$k] = $this->readArray($v,$arr);
			}else{
				$read_arr[$k] = htmlspecialchars($arr[$v]);//字符转义
			}
		}
		return $read_arr;
	}
	/**
	* 读取指定数组中，指定key的值,只有存在对应值的时候，才进行存储，，忽略null的内容
	* @param $keys 读取的值和存放的值
	* @param $arr 需要读取的数组
	* @return 返回$keys格式的新数组
	*/
	protected function readArrayExist($keys,$arr){
		foreach ($keys as $k => $v) {			
			if(is_array($v)){
				$read_arr[$k] = $this->readArrayExist($v,$arr);
			}else{
				if(!empty($arr[$v])){
					$read_arr[$k] = htmlspecialchars($arr[$v]);//字符转义
				}
			}
		}
		return $read_arr;
	}
    /**
    * 退出
    * Time:2012-11-09 19:37
	* Author: zjs
    */
    public function q(){
    	session($this->site_key,null);
    	session($this->usr_key,null);
    }
    /**
    * 获得当前的时间/或指定时间的后n天
    * 将当前时间转为MongoDate对象
    * @param $unix 表示是否返回时间磋
    * @param $hasTime 是否需要小时、时间、秒等
    * @param $more 更长的时间 按秒算
    */
    public function getTimeInfo($time=null,$more = 0,$unix = false,$hasTime = true){
    	$strTime = date(time());//获得当前时间的时间戳
    	if($time){
    		$strTime = strtotime($time);//获取指定时间的，时间戳
    	}
    	if($more){
    		$strTime += $more;
    	}
    	if($hasTime){
    		$year = "Y-m-d H:i:s";
    	}else{
    		$year = "Y-m-d";
    	}
    	if($unix){
			return intval($strTime);		
		}else{
			return date($year,$strTime);
		}
    }
    /**
    * 将时间转为MongoDate 时间对象
    * @param $date 要转化的时间字符
    */
    public function getMongoDate($date){
    	$md = new MongoDate(strtotime($date));	
    	return $md;
    }

    /**
    	MongoDate与时间戳的转换
    	$d = date('Y-m-d H:i:s',time());				//获取当前时间
		var_dump($d);
		$t = new MongoDate(strtotime($d));	//转为Mongo对象时间
		var_dump($t);
		$tt = date('Y-m-d H:i:s',$t->sec);
		var_dump($tt);
	*/
}