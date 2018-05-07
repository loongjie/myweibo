<?php

namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Db;


class Base extends Controller
{
	protected function _initialize()
	{
		parent::_initialize();
        define('USER_ID', Session::has('user_id') ? Session::get('user_id'):null);
	}

   
    //判断用户是否登陆
	protected function isLogin()
	{
		if(is_null(session('user_id'))){
			return $this->error('该用户还没登陆呢',url('index/Index/index'));
		}
	}


	//防止用户二次登陆
	protected function lreadyLogin()
	{
		if(session('user_id'))
		{
			return $this->error('该用户已经登陆了，无需登录',url('index/Home/home'));
		}
	}
    
    //异步添加分组
	public function addgroup()
	{

		if(!(request()->isAjax())){
        halt('页面不存在');
		}

       $data=[
           'groupname' =>$_POST['name'],
           'userid'=>session('user_id'),
       ];
       $res=Db::name('group')->insert($data);
       if($res=1){
           echo json_encode(array('status'=>1,'msg'=>'分组添加成功'));
       }else{
           echo json_encode(array('status'=>0,'msg'=>'分组添加失败'));
       }
	}


    //处理发表微博的url跟@

    public function replace_weibo($content){
    
    if(empty($content)) return;  
     //给url加上a链接
     $preg='/(?:http:\/\/)?([\w.]+[\w\/]*[\w.]*[\w\/]*\??[\w=\&\+\%]*)/is';
     $content=preg_replace($preg,'<a href="http://\\1" target="_blank">\\1</a>', $content);

     //给@用户加上a链接

     $preg='/@(\S+)\s/is';
     $content=preg_replace($preg,'@\\1', $content);

     return $content;
    }


    //查询分组情况

    public function group()
    {
    	$res=Db::name('group')->where('userid',session('user_id'))->select();
  		if($res){
  			return $this->assign('listfenzhu',$res);
  		}else{
  			return $this->assign('listfenzhu',null);
  		}
    }
    
    //查询当前登陆人的头像
    public function getphoto()
    {
      $res=Db::name('user')->where('id',session('user_id'))->field('photo')->find();
      $photo=$res['photo'];
      $this->assign('loginphotp',$photo);
    }
    
    //查询当前登录的关注id
    public function getCares()
    {
      $followid = array();
        $row=Db::name('relation')->where('userid',session('user_id'))->field('follow_id')->select();
        if($row){
          foreach ($row as $k => $v) {
            $followid[]=$row[$k]['follow_id'];
          }
        }
        $this->assign('followid',$followid);
    } 


}


