<?php


namespace app\index\model;
use think\Model;

class User extends Model{
	
   
   //定义用户跟weibo关联 一对多
	public function post()
	{
		return $this->hasMany('Weibo','user_id','id');
	}

}