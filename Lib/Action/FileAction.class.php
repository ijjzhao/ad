<?php
//+------------------------------
//+ 文件上传、存取等操作控制器
//+ Author:zjs
//+ Time:2012-12-05
//+------------------------------
class FileAction extends SspAction{
	private $upload_path = 'Upload/';//文件上传的路径
	private $path;//文件的路径
	private $file_io;//文件io流
	public function __construct($file_name){
		$this->path = $this->upload_path.$file_name;//文件存放路径
	}
	/**
	* 文件上传
	* @param $tmp_name 上传的文件
	*/
	public function upload_file($tmp_name){
		return move_uploaded_file($tmp_name, $this->path);
	}
	/**
	* 打开文件
	*/
	public function open_file(){
		$this->file_io = fopen($this->path, 'r');//读取文件流
		return $this->file_io;
	}
	/**
	* 读取文件
	*/
	public function read_file(){
		return fread($this->file_io,filesize($this->path));
	}
	/**
	* 关闭读取
	*/
	public function close_read(){
		fclose($this->file_io);
	}
	/**
	* 删除文件
	* @param $path文件的路径
	*/
	public function del_file(){
		unlink($this->path);
	}
	/*
	* 获取文件的路径
	*/
	public function get_path(){
		return $this->path;
	}
}