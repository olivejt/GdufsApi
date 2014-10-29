<?php
return array(
	//'配置项'=>'配置值'
		'DB_TYPE'               => 'mysql',     // 数据库类型
		'DB_HOST'               => 'localhost', // 服务器地址
		'DB_NAME'               => 'gdufsapi',      // 数据库名
		'DB_USER'               => 'root',      // 用户名
		'DB_PWD'                => '',  // 密码
		'DB_PORT'               => '3306',        // 端口
		'DB_PREFIX'             => 'api_',
		'SESSION_AUTO_START' 	=> true,
		'APP_AUTOLOAD_PATH'		=> '@.ORG',
		'TMPL_PARSE_STRING'     => array(
				'__CSS__' => __ROOT__.'/Public/css',         // css路径
				'__IMG__' => __ROOT__.'/Public/images',      // 图片路径
				'__JS__' => __ROOT__.'/Public/js',           // js路径
		),
);
?>