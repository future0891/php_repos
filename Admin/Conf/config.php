<?php
return array(
		'APP_STATUS' => 'debug', //应用调试模式状态
		'DB_DSN' => 'mysql://root:85415718@localhost:3306/think_cms',
		'DB_PREFIX' => 't_',
		'URL_MODEL' =>0,
		'TMPL_ACTION_ERROR'         =>  'Public:success',
		'TMPL_ACTION_SUCCESS'       =>  'Public:success',
		//RBAC配置
		'USER_AUTH_ON' =>true,
		'USER_AUTH_MODEL'=>"User",
		'USER_AUTH_TYPE' =>1,
		'USER_AUTH_KEY' =>'authId',
		'ADMIN_AUTH_KEY' => 'administrator',
		'USER_AUTH_GATEWAY' => '?m=Login&a=login',
		'NOT_AUTH_MODULE' =>'',
		'RBAC_ROLE_TABLE' =>'t_role',
		'RBAC_USER_TABLE' =>'t_role_user',
		'RBAC_ACCESS_TABLE' =>'t_access',
		'RBAC_NODE_TABLE'=>'t_node',
);

?>