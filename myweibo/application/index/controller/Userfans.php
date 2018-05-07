<?php

namespace app\index\controller;
use think\Db;


class Userfans extends Base{


	public function userfans()
	{
		$uid=input('id');
		$this->getCares();

		$user=Db::name('user')->where('id',$uid)->find();
      	$this->assign('user',$user);

      	$this->assign('self',session('user_id'));

      	//查询粉丝的人的信息
      	$res=Db::name('relation')->where('userid',$uid)->join('user','fans_id=user.id')->paginate(10);
      	//dump($res);exit();
      	$this->assign('res',$res);
		return $this->fetch();
	}
	//id在session('user_id')的关注中就显示取消关注，不在就显示关注
}