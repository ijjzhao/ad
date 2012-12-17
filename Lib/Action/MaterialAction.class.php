<?php
//+---------------------------------
//+ 素材逻辑处理控制器
//+ Author:zjs
//+ Time:2012-12-03
//+---------------------------------
class MaterialAction extends SspAction{
	private $upyun_img_bucket = 'material';//又拍云图片空间名称
	private $upyun_img_domain = 'http://material.b0.upaiyun.com';//图片url域名
	private $upyun_flash_bucket = 'filesystem';//又拍云文件类型空间名称
	private $upyun_flash_domain = 'http://filesystem.b0.upaiyun.com';
	private $upyun_user = 'test';//又拍云操作员帐号
	private $upyun_pass = '11111111';//又拍云操作员密码
	/**
	* index处理器
	*/
	public function index(){
		$this->assign('m','mater');
		$this->display();
	}
	/**
	* 获取素材列表
	*/
	public function lst(){
		if($this->isGet()){
			$page = $_GET['_URL_'][2];//获取查询的页数
			$mater_type = $this->getMaterType($_GET['_URL_'][3]);//根据类型筛选
			$mater_size = $this->getMaterSize($_GET['_URL_'][4]);//获取筛选的尺寸
			if (!is_numeric($page)) {
				$page = 1;
			}
			$limit = 5;
			$material_model = new MaterialModel();
			$m_list = $material_model->selectBySiteIdWithPage($this->getWebSiteId(),$mater_type,$mater_size,$page,$limit);
			$rs['page'] = $page;
			$rs['limit'] = $limit;
			$rs['sea'] = $m_list;
			$this->ajaxReturn($rs,'素材列表',1);
		}
	}
	/**
	*根据ID查找素材的详细信息
	*/
	public function inf(){
		if($this->isGet()){
			$mater_id = trim($_GET['_URL_'][2]);//获取素材编号
			if($mater_id){
				$material_model = new MaterialModel();
				$rs = $material_model->findById($mater_id);
			}
			if($rs){
				$this->ajaxReturn($rs,'素材信息',1);
			}else{
				$this->ajaxReturn(null,'查找错误',0);
			}
		}
	}
	/**
	* 统计当前站点下有多少素材
	*/
	public function cnt(){
		if($this->isGet()){
			$mater_type = $this->getMaterType($_GET['_URL_'][2]);//根据类型筛选
			$mater_size = $this->getMaterSize($_GET['_URL_'][3]);//获取筛选的尺寸
			$material_model = new MaterialModel();
			$rs = $material_model->mCount($this->getWebSiteId(),$mater_type,$mater_size);
			$this->ajaxReturn($rs,'素材数量',1);
		}
	}
	/**
	* 处理接收的类型参数
	*/
	private function getMaterType($type){
		$mater_type = strtolower(trim($type));//根据类型筛选
		$mater_type = empty($mater_type) ? 'all' : $mater_type;
		return $mater_type;
	}
	/**
	* 处理接收的尺寸
	*/
	private function getMaterSize($size){
		$mater_size = strtolower(trim($size));
		if($mater_size == 'all'){
			$mater_size = null;
		}else if($mater_size == 'np'){

		}else{
			$mater_size = explode('x', $mater_size);
			$mater_size = count($mater_size) == 2 ? $mater_size : null;
		}
		return $mater_size;
	}
	/**
	* 删除素材信息(这里的删除，只是改变其状态)
	*/
	public function del(){
		if($this->isGet()){
			$mater_id = trim($_GET['_URL_'][2]);//获取素材编号
			if($mater_id){
				$material_model = new MaterialModel();
				// $file = $material_model->findFileById($mater_id);
				// var_dump($file);
				$rs = $material_model->updateState($mater_id,0);
			}
			if($rs){
				$this->ajaxReturn($rs,'删除成功',1);
			}else{
				$this->ajaxReturn(null,'删除失败',0);
			}
		}
	}
	/**
	* 修改素材的信息
	*/
	public function upd(){
		if($this->isPost()){
			$post_keys = array('mid');//客服端必须要提交的key
			if($this->postKeyExist($post_keys)){//验证key是否存在
				$typ = $_POST['tpe'];//获取素材的类型
				$update['genre'] = $typ;
				$save['isNewWin'] = empty($_POST['nwn']) ? 'off' : 'on';
				$key_arr = $this->materialKeyInfo($typ);//获取定义的key
				$read_arr = $this->readArrayExist($key_arr,$_POST);//读取post中的值
				$update = array_merge_recursive($read_arr,$update);//数组追加
				if(isset($update['file']['resDesc'])){
					$resDesc = $update['file']['resDesc'] ;
					$update['file']['resDesc'] = $resDesc == '图片描述' ? null : $resDesc;
				}
				//实例化素材模型对象
				$material_model = new MaterialModel();
				$rs = $material_model->upMaterialById($update,$_POST['mid']);
				if($rs){
					$this->ajaxReturn(null,'修改成功',1);
				}else{
					$this->ajaxReturn(null,'修改失败',0);
				}
			}
		}	
	}
	/**
	* 添加新的素材信息
	*/
	public function newmal(){
		if($this->isPost()){
			$post_keys = array('mna','tpe');//客服端必须要提交的key
			if($this->postKeyExist($post_keys)){//验证key是否存在
				$typ = $_POST['tpe'];//获取素材的类型
				$save['genre'] = $typ;
				$save['site'] = $this->getWebSiteId();//现有数据直接存储
				$save['isNewWin'] = empty($_POST['nwn']) ? 'off' : 'on';
				//获取定义的key
				$key_arr = $this->materialKeyInfo($typ);
				$read_arr = $this->readArray($key_arr,$_POST);//读取post中的值
				$save = array_merge_recursive($read_arr,$save);//数组追加
				if(isset($save['file']['resDesc'])){
					$resDesc = $save['file']['resDesc'] ;
					$save['file']['resDesc'] = $resDesc == '图片描述' ? null : $resDesc;
				}
				//实例化素材模型对象 
				$material_model = new MaterialModel();
				$rs = $material_model->newMater($save);
				if($rs['ok']){
					$this->ajaxReturn($rs['id'],'添加成功',1);
				}else{
					$this->ajaxReturn(null,'添加失败',0);
				}
			}else{
				$this->ajaxReturn(null,'信息不完整',0);	
			}
		}
	}
	/**
	* 定义存储素材的key，或获取提交数据中的key
	*/
	private function materialKeyInfo($typ){
		$arr = array(
			'name' => 'mna','link' => 'lnk','code' => 'cde',
		);
		switch ($typ) {//判断素材类型，定义取值的格式
			case 'p':
			case 'f':
				$arr['file'] = array(
					'resUrl' => 'upna','domain'=> 'url', 'width' => 'wth','height' => 'hht','resDesc' => 'mes',
				);
				break;
			case 'w':
				$arr['file'] = array(
					'content' => 'tnt',
					'style' => array('size' => 'sze','color' => 'clr','face' => 'fce'),
					'overStyle' => array('color' => 'oclr','face' => 'ofce'),
				);
				break;
			case 's':
				$arr['file'] = 'spt';
				break;
		}	
		return $arr;	
	}
	/**
	* 图片上次的处理
	*/
	public function upload(){
		if($this->isPost() && !empty($_FILES['fle']['name'])){//验证提交方式
			$file_info = $_FILES['fle'];
			if($file_info['size'] <= 5242880){//限制为5M
				$file_name = re_fileName($file_info['name']);//重命名文件
				$upyun_path = '/'.$this->getUsr('id').'/'.$file_name;//设置在upyun上的文件路径
				$file_manager = new FileAction($file_name);//创建文件处理器
				if($file_manager->upload_file($file_info['tmp_name'])){//进行文件的上传
					$fh = $file_manager->open_file();//打开文件
					$file_type = $file_info['type'];//获取图片的类型
					//要在上传前读取flash信息
					if(is_flash($file_type)){
						$rd = $file_manager->read_file();//读取文件信息
						$flash_action = new FlashAction();//创建flash处理对象
						$flash_info = $flash_action->getswfinfo($fh,$rd);//读取flash的宽高
					}
					//创建upyun图片空间
					$upyun = $this->creatUpyun($file_type);
					$up = $upyun->writeFile($upyun_path,$fh,true);//上传文件
					if($up){
						$return_arr = array(
							'name' => $upyun_path,
							'url' => $this->upyun_flash_domain,
						);
						if(is_img($file_type)){//如果是图片类型，获取额外的信息
							$return_arr['url'] = $this->upyun_img_domain;
							$return_arr['width'] = $upyun->getWritedFileInfo('x-upyun-width');
							$return_arr['height'] = $upyun->getWritedFileInfo('x-upyun-height');
							$return_arr['frames'] = $upyun->getWritedFileInfo('x-upyun-frames');
							$return_arr['type'] = $upyun->getWritedFileInfo('x-upyun-file-type');
						}else if(is_flash($file_type)){//如果是flash文件，就读取其信息
							$return_arr = array_merge($return_arr,$flash_info);
						}
					}
					$file_manager->close_read();//关闭文件流
					$file_manager->del_file();//删除上传文件
				}
				if($return_arr){
					$this->ajaxReturn($return_arr,'上传成功',1);
				}else{
					$this->ajaxReturn(null,'上传失败',0);
				}
			}else{
				$this->ajaxReturn(null,'big',0);
			}
		}
	}
	/**
	* 根据文件类型创建对于的upyun空间
	* @param $type 资源文件的类型
	*/
	private function creatUpyun($type){
		if(is_img($type)){			
			$upyun = new UpyunAction($this->upyun_img_bucket,$this->upyun_user,$this->upyun_pass);//实例化图片空间的upyun接口对象
		}else{
			$upyun = new UpyunAction($this->upyun_flash_bucket,$this->upyun_user,$this->upyun_pass);//实例化文件空间的upyun接口对象
		}
		return $upyun;
	}
	/**
	* 删除上传文件
	*/
	public function deload(){
		if($this->isPost()){
			$file_name = $_POST['mna'];
			if($file_name){
				$file_type = get_file_type($file_name);//获取文件的类型
				//根据文件类型创建，upyun对象
				$upyun = $this->creatUpyun($file_type);
				$rs = $upyun->deleteFile($file_name);//删除文件
			}
			if($rs){
				$this->ajaxReturn(null,'删除成功',1);
			}else{
				$this->ajaxReturn(null,'删除失败',0);
			}
		}
	}
	/**
	* 获取素材的尺寸列表
	*/
	public function size(){
		$material_model = new MaterialModel();
		$rs = $material_model->groupSize($this->getWebSiteId());
		$this->ajaxReturn($rs,'尺寸列表',1);			
	}
}