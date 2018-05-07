<?php

namespace app\index\controller;
use app\index\validate\User as UserValidate;
use think\Request;
use think\Db;

class Register extends Base
{
	public function register()
	{
       return $this->fetch();
	}

	public function checkreg(Request $request)
	{
        if($request->isPost()){

             $data=[
                'name' => input('name'),
                'password'=>input('password'),
                'email' =>input('email'),
                //'varify' =>input('varify'),
             ]; 
             $userva=new UserValidate;
             $flag=$userva->scene('register')->check($data);
             if(!$flag){
                return $this->error($userva->getError());
             }else{
                $data=[
                    'name' => input('name'),
                    'password'=>input('password'),
                    'email' =>input('email'),
                    'register_time' =>time(),
                ];
                $res=Db::name('user')->where('name',input('name'))->find();

                if($res!=null){
                  return $this->error("该用户名已被使用",'register');
                }else{
                    $resrow=Db::name('user')->insert($data);
                    if($resrow==1){
                       return $this->success('注册成功！！！','index/Index/index');
                    }else{
                       return $this->error('注册失败！！！');
                    }
                
             }
             }

        }

	}

    //前端验证用户名
    public function checkname(){
        $name=input('name');

        $res=Db::name('user')->where('name',$name)->find();

        if(!$res){
            echo json_encode(array('status'=>1,'msg'=>'用户名可用'));
        }else{
            echo json_encode(array('status'=>2,'msg'=>'用户名已存在'));
        }
    }

    //前端验证验证码
    public function checkvarify()
    {
        $varify=input('varify');
        if(!captcha_check($varify)){
            echo json_encode(array('status'=>1,'msg'=>'验证失败'));
        }else{
            echo json_encode(array('status'=>2,'msg'=>'验证成功'));
        }
    }
}












