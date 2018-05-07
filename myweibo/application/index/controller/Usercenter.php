<?php

namespace app\index\controller;
use app\index\validate\User as UserValidate;
use think\Db;

class Usercenter extends Base
{
	public function index()
	{
		$this->isLogin();

        $res=Db::name('group')->where('userid',session('user_id'))->select();
        if($res){
            $this->assign('listfenzhu',$res);
        }else{
            $this->assign('listfenzhu',null);
        }

		$id=session('user_id');
        $result=Db::name('user')->where('id',$id)->find();
        if($result){
           $this->assign('result',$result);
        }
		return $this->fetch();
	}


    public function checkuserinfo()
    {
        $imag="";
    	$file=request()->file('file');
    	if($file){
    		$info=$file->validate(['ext'=>'jpg,png,gif'])->move('../uploads');

    		if($info){
               $imag=$info->getSaveName();
               //dump($imag);
               $imag=str_replace("\\","/",$imag);
               //dump($imag);exit();

    		}else{
		        $imag="moren/moren.png";
		    }

    	}else{
    		//赋予默认图片
    		$imag="moren/moren.png";
    	}

        $data=[
			  'name'=>input('name'),
			  'password'=>input('password'),
			  'email'=>input('email'),
			  'note'=>input('note'),
		];

		//验证失败了!!!!!
/*
		$validate=new UserValidate;
		if(!$validate->scene('user')->check($data)){
		    return $this->error($validate->getError());
		}else{
		    $data['photo']=$imag;
		}
*/  	

        $data['photo']=$imag;
        $data['register_time']=session('user_info')['register_time'];
        $res=Db::name('user')->where('id',session('user_id'))->update($data); 
        if($res!=0){
        	$user=Db::name('user')->where('id',session('user_id'))->find();
        	session('user_info',$user);
        	return $this->success('修改信息成功','index/index');
        }else{
        	return $this->error('修改数据失败','index');
        }  	
    }


}










