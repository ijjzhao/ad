<?php
/**
 * 客户信息管理逻辑类
 * Time:2012/12/24
 * author: wzx
 */
class  ClientAction extends SspAction{
	/**
	 * [addClient description]
	 * 添加客户信息
	 */
	function addClient(){
		if($this->isPOST()){
			$arr = $this->comins();
			if(!empty($arr)){
				$cm = new ClientModel();
				$rs = $cm->addCli($arr);
				if($rs){
					$this->ajaxReturn($rs,'添加成功！',1);
				}else{
					$this->ajaxReturn('','添加出错！',0);
				}
			}else{
				$this->ajaxReturn('','信息不全',0);
			}
		}
	}
	/**
	 * [delClient description]
	 * @return [type] [description]
	 * 删除客户信息
	 */
	function delClient(){
		$cm = new ClientModel();
		if($this->isGET()){
			if(!empty($_GET['id'])){
				$rs = $cm->delCli($_GET['id']);
				if($rs){
					$this->ajaxReturn('','删除成功！',1);
				}else{
					$this->ajaxReturn('','删除出错！',0);
				}
			}else{
				$this->ajaxReturn('','信息不全！',0);
		}
	}
	/**
	 * [upClient description]
	 * @return [type] [description]
	 * 修改客户信息
	 */
	function upClient(){
		if($this->isPOST()){
			$arr = $this->comins();
			if(!empty($arr)){
				$cm = new ClientModel();
				$rs = $cm->upCli($arr,$id['_id']);
				if($rs){
					$this->ajaxReturn($rs,'修改成功！',1);
				}else{
					$this->ajaxReturn('','修改出错！',0);
				}
			}else{
				$this->ajaxReturn('','信息不全！',0);
			}
		}
	}
	/**
	 * [selClient description]
	 * @return [type] [array]
	 * 查看客户信息
	 *全部
	 */
	function selClient(){
		if($this->isGET()){
			$cm = new ClientModel();
			$rs = $cm->selCli();
			if($rs){
				$this->ajaxReturn($rs,'操作成功！',1);
			}else{
				$this->ajaxReturn('','操作出错！',0);
			}
		}
	}
	/**
	 * [selClientById 根据id获取客户信息]
	 * @return [type] [array]
	 */
	function selClientById(){
		if($this->isGet()){
			$cm = new ClientModel();
			if(!empty($_GET['id'])){
				$r = $cm->selById($_GET['id']);
				print_r($r);
				if($r){
					$this->ajaxReturn($r,'操作成功！',1);
				}else{
					$this->ajaxReturn('','操作出错！',0);
				}
			}else{
				$this->ajaxReturn('','信息不全！',0);
			}
			
		}
	}
	/**
	 * [comins description]
	 * @param  [type] $post [description]
	 * @return [type]       [description]
	 * 公共写入方面
	 */
	function comins(){
		//$_POST=array('nme'=>'ttt','sit'=>$this->getWebSiteId(),'cst'=>1,'sta'=>1,'sne'=>'三哥','phe'=>'12112122','eml'=>'sffd@163.com','qq'=>'232323232','rmk'=>'deiyunxuan','dec'=>'testing');
		$key=array('nme','sit','sta','sne','phe','eml','qq','rmk','dec','cst');
	   if($this->postKeyExist($key)){
			$keys = array(
				'site' =>'sit',
				'name' =>'nme',
				'state' => 'sta',
				'contact' =>array(
					array(
						'name' =>'sne',
						'phone'=>'phe',
						'email'=>'eml',
						'qq' => 'qq',
						'remark' =>'rmk',
						'state' => 'cst'
					)
				),
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