<?php
/**
 * 订单管理控制器
 * Date:2012/12/20
 * Author:wzx
 */
class OrderAction extends SspAction{
		/**
		 * [add description]
		 * 新增订单
		 */	
	function addOrder(){
		$keys = array('sit','nme','sne','sta','dec','cnd');
		//$_POST = array('sit'=>$this->getWebSiteId(),'nme'=>'vv','sne'=>'dd','sta'=>1,'dec'=>'dfdfe','cnd'=>'客户联系人id');
		if($this->isPOST()){
			$arr = $this->comins($keys,$_POST);
			if(!empty($arr)){
				$od = new OrderModel();
				$rs = $od->newOrder($arr);
				if($rs['ok']){
					$this->ajaxReturn($rs['id'],'添加成功',1);
				}else{
					$this->ajaxReturn('','添加失败',0);
				}
			}else{
				$this->ajaxReturn("","信息不全",0);
			}
		}
	
	}	
	 /** [select description]
	 * @return [type] [description]
	 * 查看订单信息
	 */
	function selectOrder(){ 
		if($this->isGet()){
			$om = new OrderModel();
			$rs = $om->selOrder();
			print_r($rs);
			if($rs){
				$this->ajaxReturn($rs,'正常查看',1);
			}else{
				$this->ajaxReturn('','查看出错',0);
			}
		}
	}
	/**
	 * [selById 根据id获取]
	 * @return [type] [array]
	 */
	function selById(){
		if($this->isGet()){
			if(!empty($_GET['id'])){
				$om = new OrderModel();
				$r = $om->selById($_GET['id']);
				if($r){
					$this->ajaxReturn($r,'操作成功',1);
				}else{
					$this->ajaxReturn('','操作出错',0);
				}
			}else{
				$this->ajaxReturn('','信息不全',0);
			}	
		}
	}
	/**
	 * [del description]
	 * @return [type] [description]
	 *删除订单信息
	 *由name指定删除目标
	 */
	function delOrder(){
		if($this ->isGet()){
			if(!empty($_GET['id'])){
				$or_Id=$_GET['id'];
				$or=new OrderModel();
				$rs=$or->delOrders($or_Id);
				if($rs){
					$this->ajaxReturn($or_Id,'删除成功',1);
				}else{
					$this->ajaxReturn('','删除出错',0);
				}
			}else{
				$this->ajaxReturn('','信息不全',0);
			}	
		}
	}
	/**
	 * [upOrder description]
	 * @return [type] [description]
	 * 订单信息修改
	 * ById
	 */
	function upOrder(){
		if($this->isPOST()){
			$keys = array('sit','nme','sne','sta','dec','cnd');
			//$_POST = array('sit'=>$this->getWebSiteId(),'nme'=>'rr','sne'=>'dd','sta'=>1,'dec'=>'dfdfe','cnd'=>'客户联系人id');
			$arr= $this->comins($keys,$_POST['id']);
			if(!empty($arr)){
				$od = new OrderModel();
				$rs = $od->upOrders($arr,$_);
				if($rs){
					$this->ajaxReturn($o_id,'修改成功',1);
				}else{
					$this->ajaxReturn('','修改出错',0);
				}	
			}else{
				$this->ajaxReturn("","信息不全",0);
			}
		}	
	}
	/**
	 * [comins description]
	 * @param  [type] $post [description]
	 * @return [type]       [description]
	 * 公共写入方面
	 */
	function comins($keys,$_POST){
	   if($this->postKeyExist($keys)){
			$keys = array(
				'site' =>'sit',
				'name' => 'nme',
				'salesman' => array(
					'name' =>'sne'
				),
				'clientele' =>'cnd',
				'state' => 'sta',
				'desc' => 'dec'
			);
			$arr=$this->readArray($keys,$_POST);
			return $arr;
		}else{
			return null;
		}		
	}
}
?>