<?php
//+----------------------------------------------------------------
//+ 
//+ Time:2012-11-09 19:39  
//+ Author: zjs
//+----------------------------------------------------------------
class IndexAction extends SspAction {
	/**
	* 默认页面
	* Time:2012-11-09 18:32
	* Author: zjs
	*/
    public function index(){
        // echo $_GET['name'];
    	$this->loca();
    }
    /**
    * 广告位页面
    */
    public function loca(){
    	$this->display('loca');
    }
}