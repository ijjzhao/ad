<?php
	return array(
		//'配置项'=>'配置值'
		'URL_MODEL' => '2',//URL模式
		'URL_CASE_INSENSITIVE' => true,//URL不区分大小写
		'SESSION_AUTO_START' => true, //是否开启session
		'DB_TYPE'=>'mongo', // 使用的数据库是mysql
		'DB_HOST'=>'localhost',
		'DB_NAME'=>'alsogood',// 数据库名
		'DB_USER'=>'',
		'DB_PWD'=>'',// 填写你连接数据库的密码
		'DB_PORT'=>'27017',
		'DB_PREFIX'=>'', // 数据表表名的前缀 
		// 'URL_ROUTER_ON' => true,//开启路由
		// 'URL_ROUTE_RULES' => array(//定义路由规则
		// 	'index:name' => 'index/loca'
		// ),
	);
?>