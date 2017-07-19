<?php
include_once 'common.php';
$action		=   isset($_POST['action']) ? trim($_POST['action']) : '';
if(!$action){
	returnAjaxMsg('201', '操作非法!');
}

if($action == 'add'){

}else if($action == 'select'){

}

returnAjaxMsg($arr);

/**
 * 生成群组唯一标识
 * @return [type] [description]
 */
function makeGroup(){
	global $db;
	$string 	=	'a1b2c3d4e5f6g7h8i9jklmnopqrstuvwxyz';
	$prefix 	=	'';
	$length		=	strlen($string) - 1;
	for($i = 1; $i<= 2; $i++){
		$prefix .=	$string[mt_rand(0, $length)];
	}

	$group 	=	uniqid($prefix);
	$sql 	=	'select id from groups where unique_str = "'.$group.'"';
	$res 	=	$db->fetch($sql);
	
	return empty($res) ? $group : '';
}
?>