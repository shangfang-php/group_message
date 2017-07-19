<?php
namespace app\index\Controller;
use think\Controller;
use think\Paginator;
use think\Db;
class Index extends Controller{
    public function index(){
        $group_id = 1;
        $list = Db::name('message')->where(['group_id'=>$group_id])->order('id desc')->limit(5)->select();
        sort($list);
        //echo '<pre>';
       // print_r($list);exit;
        $this->assign('data',$list);
        return $this->fetch('weixin');
    }
}