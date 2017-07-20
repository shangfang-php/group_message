<?php
include_once 'common.php';
$group_name     =   isset($_POST['name']) ? trim($_POST['name']) : '';
$group_string 	=	makeGroup();
if(!$group_string){
	returnAjaxMsg('201', '生成群标识失败!');
}
if($group_name){
	$sql 	=	'insert into groups (unique_str,name) values ("'.$group_string.'","'.$group_name.'")';
}else{
	$sql 	=	'insert into groups (unique_str) values ("'.$group_string.'")';
}

$info 	=	$db->query($sql);
if($info){
	$arr 	=	array('group'=>$group_string);
	$code	=	'200';
	$msg 	=	'生成群标识成功!';
}else{
	$arr 	=	array();
	$code 	=	'202';
	$msg 	=	'保存群标识失败!';
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