<?php
namespace app\index\Controller;
use think\Controller;
use think\Db;
class Index extends Controller{
    public function index($group = ''){
        if(!$group){
        	echo '群不存在!';
        	exit;
        }

        $group_info 	=	Db::table('groups')->field('id')->where(array('unique_str'=>$group))->find();
        if(!$group_info){
        	echo '群不存在!';
        	exit;
        }
        $group_id =	$group_info['id'];

        $list = Db::name('message')->where(['group_id'=>$group_id])->order('id desc')->limit(5)->select();
        //sort($list);
        //echo '<pre>';
         //print_r($list);exit;
        $this->assign('data',$list);
        return $this->fetch('weixin');
    }
}