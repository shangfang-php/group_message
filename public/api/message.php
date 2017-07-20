<?php
include_once 'common.php';
$action		=   isset($_GET['action']) ? trim($_GET['action']) : '';
if(!$action){
	returnAjaxMsg('201', '操作非法!');
}

if($action == 'add'){
	add_message();
}else if($action == 'select'){
	search_message();
}

returnAjaxMsg($arr);

/**
 * 添加消息记录
 */
function add_message(){
	global $db, $code, $msg;
	$group 	=	isset($_POST['group']) ? trim($_POST['group']) : ''; ##群标识
	$img_url=	isset($_POST['img']) ? trim($_POST['img']) : ''; ##图片地址
	$content=	isset($_POST['content']) ? trim($_POST['content']) : ''; ##文案内容
	$time 	=	isset($_POST['time']) ? trim($_POST['time']) : ''; ##时间 不传则默认为接收时间
	$time 	=	$time ? $time : time();

	if(!$group){
		$code 	=	'201';
		$msg 	=	'群号不能为空';
		returnAjaxMsg();
	}

	if(!$img_url){
		$code 	=	'202';
		$msg 	=	'图片链接不能为空';
		returnAjaxMsg();
	}

	if(!$content){
		$code 	=	'203';
		$msg 	=	'文案内容不能为空';
		returnAjaxMsg();
	}

	$sql	=	"select id from groups where unique_str = '{$group}'";
	$res 	=	$db->fetch($sql);
	if(empty($res)){
		$code 	=	'204';
		$msg 	=	'找不到对应群信息';
		returnAjaxMsg();
	}
	$group_id 	=	$res['id'];

	$sql 	=	"insert into message (group_id,img_url,content,time) values ('{$group_id}', '{$img_url}', '{$content}','{$time}')";
	$info 	=	$db->query($sql);
	if($info){
		$code	=	'200';
		$msg 	=	'保存成功!';
	}else{
		$code 	=	'202';
		$msg 	=	'保存失败!';
	}
	returnAjaxMsg();
	exit;
}

/**
 * 查询记录
 * @return [type] [description]
 */
function search_message(){
	global $db, $code, $msg;
	$group 	=	isset($_POST['group']) ? trim($_POST['group']) : '';
	$page 	=	isset($_POST['page']) ? trim($_POST['page']) : 1;
	$pageSize=	isset($_POST['pageSize']) ? trim($_POST['pageSize']) : 10;

	if(!$group){
		$code 	=	'301';
		$msg 	=	'群号不能为空';
		returnAjaxMsg();
	}

	$sql	=	"select id from groups where unique_str = '{$group}'";
	$res 	=	$db->fetch($sql);
	if(empty($res)){
		$code 	=	'302';
		$msg 	=	'找不到对应群信息';
		returnAjaxMsg();
	}
	$group_id 	=	$res['id'];
	$start  =	($page - 1) * 10;
	$sql 	=	"select * from message where group_id='{$group_id}' order by id desc limit $start,$pageSize";
	$res 	=	$db->fetch_all($sql);
	$code  	= 	200;
	$msg 	=	'获取成功!';
	returnAjaxMsg(array('data'=>$res));
	exit;
}
?>