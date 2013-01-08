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
        $this->ad();
    }
    /**
    * 广告页面
    */
    public function ad(){
        $this->assign('m','ad');
        $this->display('ad');
    }
    /**
    * 广告位页面
    */
    public function loca(){
        $this->assign('m','loca');
    	$this->display('loca');
    }
    /**
    * 素材页面
    */
    public function mater(){
        $this->assign('m','mater');
        $this->display('mater');
    }
}