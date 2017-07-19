<?php
include_once 'db.class.php';
$db 	=	Db::getInstance();
$code	=	'0';
$msg 	=	'';

/**
 * 接口返回json信息
 * @param  string $arr [description]
 * @return [type]      [description]
 */
function returnAjaxMsg($arr = ''){
	global $code, $msg;
	$return 	=	array('code'=>$code, 'msg'=>$msg);
	if(!empty($arr)){
		$return 	=	array_merge($return, $arr);
	}

	echo json_encode($return);
	exit;
}
?>