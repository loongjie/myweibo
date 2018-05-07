<?php

namespace app\index\validate;
use think\Validate;

class User extends Validate
{
	protected $rule= [

        'user'  => 'require|min:4',
        'name'  => 'require|min:4',
        'password' => 'require|min:6',
        'tpassword' =>'require|confirm:password',
        'email' =>'require|email',
        'varify|验证码'=>'require|captcha',
        'note' =>'max:255',     
	];

	 protected $message  =   [
        'user.require' => '名称必须',
        'user.min' => '名称最少4个字符',
        'name.min'     => '名称最少4个字符',
        'password.require'  => '密码必须',
        'password.min'  => '密码最少6个字符', 
        'varify.captcha' => '验证码错误了',
        'email.require'  => '邮箱必须', 
        'email.email'  => '邮箱格式错误',
        'name.require' => '名称必须', 
        'tpassword.confirm' => '两次密码输入不一致',
        'note.max' => '最大255个字符',
    ];

     protected $scene = [
        'index'  =>  ['user','password'],
        'register'  =>  ['name','password','email'],
        'user' =>['name','password','email','note'],
    ];

}