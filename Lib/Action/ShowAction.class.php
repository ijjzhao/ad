<?php
//+----------------------------------------------------------------
//+ 广告显示的API
//+ Time:2013-01-08 14:28
//+ Author: zjs
//+----------------------------------------------------------------
class ShowAction extends Action{

	public function index(){
		if($this->isGet()){
			$seat_id = trim($_GET['_URL_'][2]);//获取广告位的编号
			$bill_model = new BillModel();
			$rs = $bill_model->showById($seat_id);
			print_r($rs);
		}
	}
}