<?php
include_once 'common.php';
delete_data();

function delete_data(){
	global $db;
	$lastday=	strtotime(date('Y-m-d' ,strtotime('-1 day')));
	$sql 	=	'delete from message where time <'.$lastday; ##删除昨天之前的数据
	$db->query($sql);
}
?>