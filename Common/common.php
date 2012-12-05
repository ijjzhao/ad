<?php
/**
* 重命名上传文件的名字
*/
function re_fileName($fileName){
	$file_info = explode('.', $fileName);
	$file_name = $file_info[0];//获取名称
	$file_type = $file_info[1];//获取文件的后缀名
	$str_time = strtotime(date('Y-m-d H:i:s'));//获取当前时间的，时间戳
	$rand = rand(1000,9999);//获取随机数
	$name = md5($str_time.'_'.$file_name.'_'.$rand);
	$name = $name.'.'.$file_type;
	return $name;
}
/**
* 验证是否是图片
*/
function is_img($type){
	$img = false;
	$imgs = array('image/gif','image/jpeg','image/pjpeg','image/png');
	foreach ($imgs as $k => $v) {
		if($type == $v){
			$img = true;
			break;
		}
	}
	return $img;
}
/**
* 验证文件是否是flash类型
*/
function is_flash($type){
	$flash = false;
	$flashs = array('application/x-shockwave-flash');
	foreach ($flashs as $k => $v) {
		if($type == $v){
			$flash = true;
			break;
		}
	}
	return $flash;
}
