<?php

namespace app\index\controller;
use think\Db;


class Usercare extends Base{


	public function usercare()
	{
		$uid=input('id');
		$this->getCares();

		$user=Db::name('user')->where('id',$uid)->find();
      	$this->assign('user',$user);

      	$this->assign('self',session('user_id'));

      	//查询关注的人的信息
      	$res=Db::name('relation')->where('userid',$uid)->join('user','follow_id=user.id')->paginate(10);
      	//dump($res);exit();
      	$this->assign('res',$res);
		return $this->fetch();
	}
}

