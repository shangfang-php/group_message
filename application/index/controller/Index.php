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
        $online_nums =  rand(100,200); 
        $data   =   array('current_page'=>1, 'group'=>$group, 'data'=>$list, 'online_nums'=>$online_nums);

        $this->assign($data);
        return $this->fetch('weixin');
    }

    /**
     * 获取最新型消息
     * @return [type] [description]
     */
    function get_new_message(){
        $group  =   isset($_POST['group']) ? trim($_POST['group']) : '';
        $id     =   isset($_POST['id']) ? intval(trim($_POST['id'])) : '';

        if(!$group){
            $code   =   '301';
            $msg    =   '群号不能为空';
            echo json_encode(array('code'=>$code, 'msg'=>$msg));
            exit;
        }

        if(!$id){
            $code   =   '302';
            $msg    =   'ID不能为空';
            echo json_encode(array('code'=>$code, 'msg'=>$msg));
            exit;
        }

        $res    =   Db::table('groups')->field('id')->where(array('unique_str'=>$group))->find();
        if(empty($res)){
            $code   =   '303';
            $msg    =   '群号不存在';
            echo json_encode(array('code'=>$code, 'msg'=>$msg));
            exit;
        }
        $group_id   =   $res['id'];
        $res        =   Db::table('message')->where(array('group_id'=>$group_id, 'id'=>['>', $id]))->order('id','desc')->select();
        if(!$res){
            $code   =   '304';
            $msg    =   '无数据';
            echo json_encode(array('code'=>$code, 'msg'=>$msg));
            exit;
        }else{
            $code   =   '200';
            $msg    =   '成功';
            echo json_encode(array('code'=>$code, 'msg'=>$msg, 'data'=>$res));
            exit;
        }

    }
}