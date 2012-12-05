<?php
//+---------------------------------
//+ 素材逻辑处理控制器
//+ Author:zjs
//+ Time:2012-12-03
//+---------------------------------
class MaterialAction extends SspAction{
	private $upyun_img_bucket = 'material';//又拍云图片空间名称
	private $upyun_img_domain = 'http://material.b0.upaiyun.com';//图片url域名
	private $upyun_flash_bucket = 'filesytem';//又拍云文件类型空间名称
	private $upyun_flash_domain = 'http://filesytem.b0.upaiyun.com';
	private $upyun_user = 'test';//又拍云操作员帐号
	private $upyun_pass = '11111111';//又拍云操作员密码
	/**
	* index处理器
	*/
	public function index(){
		
		// $this->display();
	}
	/**
	* 获取素材列表
	*/
	public function lst(){
		if($this->isGet()){
			$page = $_GET['_URL_'][2];//获取查询的页数
			if (!is_numeric($page)) {
				$page = 1;
			}
			$limit = 1;
			$material_model = new MaterialModel();
			$rs = $material_model->selectBySiteIdWithPage($this->getWebSiteId(),$page,$limit);
			$rs['page'] = $page;
			$rs['limit'] = $limit;
			$this->ajaxReturn($rs,'素材列表',1);
		}
	}
	public function cnt(){
		if($this->isGet() || $this->isPost()){
			$material_model = new MaterialModel();
			$rs = $material_model->mCount($this->getWebSiteId());
			$this->ajaxReturn($rs,'素材数量',1);
		}
	}
	/**
	* 添加新的素材信息
	*/
	public function newmal(){
		if($this->isPost()){
			$post_keys = array('mna','lnk','nwn','tpe');//客服端必须要提交的key
			if($this->postKeyExist($post_keys)){//验证key是否存在
				$typ = $_POST['tpe'];//获取素材的类型
				$arr = array(
					'name' => 'mna','link' => 'lnk','code' => 'cde','isNewWin' => 'nwn',
				);//定义读取数据的格式
				$save['site'] = $this->getWebSiteId();//存储的数据
				switch ($typ) {//判断素材类型，定义取值的格式
					case 'p':
					case 'f':
						$arr['file'] = array(
							'resUrl' => 'url', 'width' => 'wth','height' => 'hht','resDesc' => 'mes',
						);
						$save['file']['genre'] = $typ;
						break;
					case 'w':
						$arr['words'] = array(
							'content' => 'tnt',
							'style' => array('size' => 'sze','color' => 'clr','face' => 'fce'),
							'overStyle' => array('color' => 'oclr','face' => 'ofce'),
						);
						break;
					case 's':
						$arr['script'] = 'spt';
						break;
				}			
				// $_POST = array(
				// 	'mna' => '我哈哈',
				// 	'lnk' => 'www.baidu.com',
				// 	'nwn' => 'off',
				// 	'spt' => '<script>alert("123");</script>'
				// );	
				$read_arr = $this->readArray($arr,$_POST);//读取post中的值
				$save = array_merge_recursive($read_arr,$save);//数组追加
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
	* 图片上次的处理
	*/
	public function upload(){
		if($this->isPost() && !empty($_FILES['fle']['name'])){//验证提交方式
			$file_info = $_FILES['fle'];
			$file_name = re_fileName($file_info['name']);//重命名文件
			$upyun_path = '/'.$this->getUsr('id').'/'.$file_name;//设置在upyun上的文件路径
			$file_manager = new FileAction($file_name);//创建文件处理器
			//验证上传文件的类型
			if(is_img($file_info['type'])){
				if($file_manager->upload_file($file_info['tmp_name'])){//进行文件的上传
					$fh = $file_manager->read_file();//读取文件的流
					$return_arr = $this->upLoadImg($upyun_path,$fh);//上传图片到又拍云并获取到返回信息
					$file_manager->close_read();//关闭文件流
					$file_manager->del_file();//删除上传文件
				}
			}else if(is_flash($file_info['type'])){
				if($file_manager->upload_file($file_info['tmp_name'])){//进行文件的上传
					$fh = $file_manager->read_file();//读取文件的流
					$return_arr = $this->upLoadFlash($upyun_path,$fh);//上传flash到又拍云并获取到返回信息
					$file_manager->close_read();//关闭文件流
					$file_manager->del_file();//删除上传文件
				}
			}else{
				$this->ajaxReturn(null,'非法文件',0);	
			}
			if($return_arr){
				$this->ajaxReturn($return_arr,'上传成功',1);
			}else{
				$this->ajaxReturn(null,'上传失败',0);
			}
		}
	}
	/**
	* 上传图片文件的处理
	* @param $upyun_path 在upyun上的文件路径
	* @param $fh 文件流
	*/
	private function upLoadImg($upyun_path,$fh){
		$upyun = new UpyunAction($this->upyun_img_bucket,$this->upyun_user,$this->upyun_pass);//实例化图片空间的upyun接口对象
		$up = $upyun->writeFile($upyun_path,$fh,true);//上传文件
		$arr = array(
			'name' => $upyun_path,
			'url' => $this->upyun_img_domain,
			'width' => $upyun->getWritedFileInfo('x-upyun-width'),
			'height' => $upyun->getWritedFileInfo('x-upyun-height'),
			'frames' => $upyun->getWritedFileInfo('x-upyun-frames'),
			'type' => $upyun->getWritedFileInfo('x-upyun-file-type')
		);
		return $arr;
	}
	/**
	* 上传flash文件的处理
	* @param $upyun_path 在upyun上的文件路径
	* @param $fh 文件流
	*/
	private function upLoadFlash($upyun_path,$fh){
		$upyun = new UpyunAction($this->upyun_flash_bucket,$this->upyun_user,$this->upyun_pass);//实例化文件空间的upyun接口对象
		$up = $upyun->writeFile('/'.$upyun_path,$fh,true);//上传文件
		$arr = array(
			'name' => $upyun_path,
			'url' => $this->upyun_flash_domain,
		);
		return $arr;
	}
}