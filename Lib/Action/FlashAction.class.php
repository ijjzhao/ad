<?php
/**
* 获取flash文件的宽高
*/
class FlashAction extends Action{
	public function __construct() {}
	public function getswfinfo($rs,$str){
	    if($str[0] == "f"){
	       //echo "文件已是解压缩的文件:";
	    } else {
	       $first = substr($str,0,8);
	       $last = substr($str,8);
	       //
	       $last = gzuncompress($last);
	       //
	       $str = $first . $last ;
	       $str[0] = "f";
	       //echo "解压缩后的文件信息:";
	    }
	    $info = $this->getinfo( $str );
	    return $info;
	}
	private function mydecbin($str,$index){
	    $fbin = decbin(ord($str[$index]));
	    while(strlen($fbin)<8)$fbin="0".$fbin;
	    return $fbin;
	}
	private function getinfo($str){
	    //换算成二进制
	    $fbin = $this->mydecbin($str,8) ;
	    //计算rec的单位长度
	    $slen = bindec( substr( $fbin , 0 , 5 ) );
	    //计算rec所在的字节
	    $recsize = $slen * 4 + 5 ;
	    $recsize = ceil( $recsize / 8 ) ;
	    //rec的二进制
	    $recbin = $fbin ;
	    for( $i = 9 ; $i < $recsize + 8 ; $i++ ){
	       $recbin .= $this->mydecbin( $str ,$i );
	    }
	    //rec数据
	    $rec = array();
	    for( $i = 0 ; $i < 4 ; $i++ ){
	       $rec[] = bindec( substr( $recbin , 5 + $i * $slen , $slen ) ) / 20 ;
	    }
	    return  array(
	    	'width' => $rec[1],
	    	'height' => $rec[3]
	    );
	}
}