<?php


namespace app\index\controller;
use think\Db;

class User extends Base
{
	public function user()
	{
		$this->isLogin();
		$this->getphoto();
		$this->getCares();
		$uid=input('id');
		$user=Db::name('user')->where('id',$uid)->find();
      	$this->assign('user',$user);
		

		//查询微博
		
        $field =array('user.id'=>'uid','wb_weibo.id'=>'wbid','name','photo','time','isturn','content','picture','turn','comment','keep','note');     
        $result=Db::name('weibo')->where('userid',$uid)->order('time','desc')->join('user',"userid=user.id")->field($field)->select();
       //遍历找出转发的微博，将转发微博内容赋予isturn
        if($result){
        	foreach ($result as $k => $v) {
        		if($v['isturn']){

        			$row=Db::name('weibo')->where('wb_weibo.id',$v['isturn'])->join('user',"userid=user.id")->find();
        			$result[$k]['isturn']=$row;       			
        		}
        	}
        }

      
       
       	//dump($followid);exit();
        //dump($result);exit();
        $this->assign('weibo',$result); //传递微博信息
        $this->assign('self',session('user_id')); //传递登陆号的id

		return $this->fetch();		
	}
    
   
    //转发
	public function relay()
	{
		if(!request()->isPost()){
			$this->error('页面不存在');
		}

		$weiboid=input('wbid');
		$content=input('turntext');

		$data=[
			'userid' =>session('user_id'),
			'content'=>input('turntext'),
			'isturn' =>input('wbid'),
			'time'   =>time(),
		];

		$res=Db::name('weibo')->insert($data);
		if($res==1){
			Db::name('user')->where('id',session('user_id'))->setInc('weibonum');
			Db::name('weibo')->where('id',$weiboid)->setInc('turn');
         	$this->success('转发成功');
		}else{
			$this->error('转发失败');
		}
	}

	//收藏
	public function myKeep()
	{
		$this->getCares();
		$this->getphoto();
		$uid=input('id');

		$user=Db::name('user')->where('id',$uid)->find();
		$this->assign('user',$user);

		$field =array('user.id'=>'uid','weibo.id'=>'wbid','name','photo','weibo.time'=>'time','isturn','content','picture','turn','comment','keep','note'); 
		$result=Db::name('keep')->where('user_id',$uid)->join('user',"user_id=user.id")->join('weibo',"weibo_id=weibo.id")->field($field)->paginate(5)->each(function($v,$k){
				if($v['isturn']){

        			$row=Db::name('weibo')->where('wb_weibo.id',$v['isturn'])->join('user',"userid=user.id")->find();
        			$v['isturn']=$row;       			
        		}
        		return $v;

		});    		
		//dump($result);exit();
		$this->assign('weibo',$result); 
		$this->assign('self',session('user_id'));
		return $this->fetch('user');	
	}

	//关注
	public function care()
	{
		$uid=input('uid');
		
		$data1=[
			'userid'=>session('user_id'),
			'follow_id'=>$uid,
		];
		$data2=[
			'userid'=>$uid,
			'fans_id'=>session('user_id'),
		];
		if(Db::name('relation')->where($data1)->select()){
			echo json_encode(array('status'=>3,'msg'=>'你已经关注TA了'));
			return;				
		}
		Db::startTrans();
		try {
			Db::name('relation')->insert($data1);		    
			Db::name('relation')->insert($data2);
		    Db::commit();
		} catch (\Exception $e) {
		    Db::rollback();
		}
		if(Db::name('relation')->where($data1)->select()){
			Db::name('user')->where('id',"session('user_id')")->setInc('cares');
			Db::name('user')->where('id',$uid)->setInc('fans');
			echo json_encode(array('status'=>1,'msg'=>'关注成功'));
		}else{
			echo json_encode(array('status' =>2 ,'msg'=>'关注失败'));
		}

	}

	//取消关注
	public function nocare(){
		$uid=input('uid');

		$data1=[
			'userid'=>session('user_id'),
			'follow_id'=>$uid,
		];
		$data2=[
			'userid'=>$uid,
			'fans_id'=>session('user_id'),
		];

		if(!Db::name('relation')->where($data1)->select()){
			echo json_encode(array('status'=>3,'msg'=>'你就没关注TA'));
			return;
		}

		Db::startTrans();
		try {
			Db::name('relation')->where($data1)->delete();
			Db::name('relation')->where($data2)->delete();
		    Db::commit();
		} catch (\Exception $e) {
		    Db::rollback();
		}
		if(Db::name('relation')->where($data1)->select()){
			echo json_encode(array('status' =>2 ,'msg'=>'取消关注失败'));
		}else{			
			Db::name('user')->where('id',session('user_id'))->setDec('cares');
			Db::name('user')->where('id',$uid)->setDec('fans');
			echo json_encode(array('status'=>1,'msg'=>'取消关注成功'));
		}

	}




}

