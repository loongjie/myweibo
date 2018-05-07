<?php
namespace app\index\controller;
use think\Request;
use think\Session;
use think\Cookie;
use think\Db;
use app\index\validate\User as UserValidate;
use app\index\model\User as UserModel;

class Index extends Base
{
    public function index()
    {
        $this->lreadyLogin();
    	return $this->fetch();
    }
    
    //验证登陆
    public function checkLogin(Request $request)
    {
    	if($request->isPost()){
            $data=$request->param();
            $userva=new UserValidate;
            if(!$userva->scene('index')->check($data)){
                return $this->error($userva->getError());
            }else{

                $row=[
                  'name' => $data['user'],
                  'password' => $data['password'],
                ];
                $user=UserModel::get($row);
                if($user==null){
                    return $this->error('登陆失败');
                }else{
                    if(isset($data['online'])){
                      Cookie::set('name',$user['name'],3600);
                      Cookie::set('password',$user['password'],3600);
                    }
                    session('user_id',$user->id);
                    session('user_info',$user->getData());
                    $this->redirect('index/Home/home');           
                }
            }

        }
    } 

     //前端验证用户名
     public function checkusername(){
        $name=input('name');

        $row=Db::name('user')->where('name',$name)->find();
        if(!$row){
            echo json_encode(array('status'=>1,'msg'=>'用户名不存在'));
        }else{
            echo json_encode(array('status'=>2,'msg'=>''));
        }
     } 

     //前端验证密码
     public function checkpsw(){
        $name=input('name');
        $psw=input('psw');

        $data=[
            'name'=>$name,
            'password'=>$psw,
        ];

        $res=Db::name('user')->where('name',$name)->value('password');
        if($psw!=$res){
            echo json_encode(array('status'=>1,'msg'=>'密码错误'));
        }else{
            echo json_encode(array('status'=>2,'msg'=>''));
        }
     }  

     //前端验证验证码
     public function checkvrity(){
        $vrity=input('vrty');

        if(!captcha_check($vrity)){
            echo json_encode(array('status'=>1,'msg'=>'验证失败'));
        }else{
            echo json_encode(array('status'=>2,'msg'=>'验证成功'));
        }
     }

}
