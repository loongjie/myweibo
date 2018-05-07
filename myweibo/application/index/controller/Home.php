<?php
namespace app\index\controller;
use think\Request;
use think\Session;
use think\Db;
use app\index\model\Keep as keepModel;
use app\index\model\Relation as relationModel;

class Home extends Base
{
    //热们模块
	public function home(Request $request)
	{
		$this->isLogin();
		$this->getCares();
		$this->group();
		$this->getphoto();

		$user=Db::name('user')->where('id',session('user_id'))->find();
      	$this->assign('user',$user);
        
        //查询微博
        $field =array('user.id'=>'uid','wb_weibo.id'=>'wbid','name','photo','time','isturn','content','picture','turn','comment','keep');  

        $result=Db::name('weibo')->order('time','desc')->join('user',"userid=user.id")->field($field)->paginate(5)->each(function($items, $k){

        		if($items['isturn']){

        			$row=Db::name('weibo')->where('wb_weibo.id',$items['isturn'])->join('user',"userid=user.id")->find();
        			$items['isturn']=$row;       			
        		}
        		return $items;
        });

        $this->assign('weibo',$result);
        $this->assign('self',session('user_id'));
        //$this->assign('picture',$result['picture']);

        

		return $this->fetch();
	}
    //动态模块
	public function trends(Request $request)
	{
		$this->getCares();
		$this->isLogin();
		$this->group();
		$this->getphoto();

		$user=Db::name('user')->where('id',session('user_id'))->find();
      	$this->assign('user',$user);
       //查询当前用户关注的人的微博
      /* $result=Db::name('weibo')->order('time','desc')->join('relation','relation.follow_id = weibo.userid')->join('user','user.id = weibo.userid')->select();*/
       //查询关注人的微博
        $field =array('user.id'=>'uid','wb_weibo.id'=>'wbid','name','photo','time','isturn','content','picture','turn','comment','keep'); 
        //查询关注人的id
        $floid=Db::name('relation')->where('userid',session('user_id'))->field('follow_id')->select();
        //dump($floid);exit();
        $followid=[];
        foreach ($floid as $k => $v) {      	
        	$followid[]=$v['follow_id'];  
        }  
		
        $result=Db::name('weibo')->where('userid','in',$followid)->order('time','desc')->join('user',"userid=user.id")->field($field)->paginate(5)->each(function($v,$k){
        		if($v['isturn']){
        			$row=Db::name('weibo')->where('wb_weibo.id',$v['isturn'])->join('user',"userid=user.id")->find();
        			$v['isturn']=$row;      			       			
        		}
        		return $v;
        });
        $this->assign('weibo',$result);
        $this->assign('self',session('user_id'));
       return $this->fetch('home');
	}

	//自己微博模块
	public function self(Request $request){
		$this->isLogin();
		$this->getCares();
        $this->group();
        $this->getphoto();
        $user=Db::name('user')->where('id',session('user_id'))->find();
      	$this->assign('user',$user);

        $field =array('user.id'=>'uid','wb_weibo.id'=>'wbid','name','photo','time','isturn','content','picture','turn','comment','keep'); 
        $result=Db::name('weibo')->where('userid',session('user_id'))->field($field)->join('user','user.id =userid')->order('time','desc')->paginate(5)->each(function($v,$k){
        		if($v['isturn']){
        			$row=Db::name('weibo')->where('wb_weibo.id',$v['isturn'])->join('user',"userid=user.id")->find();
        			$v['isturn']=$row;       			
        		}
        		return $v;
        });

        $this->assign('weibo',$result);
        $this->assign('self',session('user_id'));
        return $this->fetch('home');
	}

    //退出登录
	public function loginOut()
	{
		session(null);
		return $this->fetch('index/index');
	}
    
    //发表微博,上传图片
    public function postweibo(Request $request) 
    {

    	if(!request()->isPost()){
            halt('页面不存在');
    	}
         $content=input('textarea'); 
         //$content=$this->replace_weibo($content);
         //$content=nl2br($content);
         $picture="";
         $id=session('user_id');

         $file = request()->file('image');  //返回的是对象
         if($file ){
         	$info = $file->move( '../uploads');
         	if($info){
		        $picture=$info->getSaveName();
		        $picture=str_replace("\\","/",$picture);
		    }else{
		        echo $file->getError();
	         }
	     }
         if(!$content && !$picture){
           $this->error('你都还没有写微博呢~~~');
         }
	     $data=[
            'userid' =>$id,
            'content' =>$content,
            'picture' =>$picture,
            'time' =>time(),
	     ];

	     $result=Db::name('weibo')->insert($data);
	     if($result==1){
	     	Db::name('user')->where('id',$id)->setInc('weibonum');
	     	return $this->success('微博发布成功~~~','home');
	     }else{
	     	return $this->error('发送失败，出问题了~~~~');
	     }


    }
    


    //异步获取评论
	public function getComment()
	{
		
		if(!request()->isAjax()){
			$this->error('页面不存在');
		}

		$weiboid=$_POST['wid'];  //得到发表微博的id

		//总评论数
		$count=Db::name('comment')->where('weibo_id',$weiboid)->count();
		//总页数
		$pageAll=ceil($count/5);
		$page=isset($_POST['page'])? $_POST['page'] :1;
		$limit=$page<2 ? '0,5' : (5*($page-1)).',5';

		$res=Db::name('comment')->where('weibo_id',$weiboid)->order('time','desc')->limit($limit)->join('user','user.id=user_id')->select();

		if($res){
			$str='';
			foreach ($res as $k => $v) {
				$str.='<div class="discuss">';
		        $str.='<img src="';
		        $str.='http://localhost/myweibo/uploads';
				$str.='/'.$v['photo'].'" />';
		        $str.='<p>'.$v['name'].':&nbsp;&nbsp;'.$v['content'].'</p>';  
		        $str.='</div>'; 
			}

			if($pageAll>1){
				$str.='<dl class="comment-page">';

				switch ($page) {
					case $page > 1 && $page < $pageAll :
						$str.='<dd page="'.($page-1).'" wid="'.$weiboid.'">上一页</dd>';
						$str.='<dd page="'.($page+1).'"wid="'.$weiboid.'">下一页</dd>';
						break;
					case $page < $pageAll:
						$str.='<dd page="'.($page+1).'"wid="'.$weiboid.'">下一页</dd>';
						break;
					case $page==$pageAll:
						$str.='<dd page="'.($page-1).'"wid="'.$weiboid.'">上一页</dd>';
						break;
					
				}

				$str.='</dl>';
			}

			echo $str;
		}else{
			echo "false";
		} 
       

	}

	//异步收藏
	public function keep()
	{
		
		if(!request()->isAjax())
		{
			$this->error('页面不存在');
		}

		$weiboid=$_POST['weiboid'];

		$data=[
			'user_id' => session('user_id'),
			'weibo_id' => $weiboid,
		];
		$res=keepModel::get($data);
        if($res!=null){
        	echo json_encode(array('status'=>3,'msg'=>'你已经收藏了哦！'));
        	die();
        }
	
        $data['time']=time();
        if(!empty($weiboid) && !empty(session('user_id'))){
        	$result=Db::name('keep')->insert($data);
        	if($result=1){
        		Db::name('weibo')->where('id',$weiboid)->setInc('keep');
        		echo json_encode(array('status'=>1,'msg'=>'收藏成功'));
        	}else{
        		echo json_encode(array('status'=>2,'msg'=>'收藏失败'));
        	}
        }
		
	}

	//异步关注
	public function ralation()
	{
		if(!request()->isAjax()){
			$this->error('页面不存在');
		}
        // userid follow_id fans_id
		$uid=$_POST['uid'];
		if(empty($uid)||empty(session('user_id'))){
			$this->error('页面不存在');
		}
		$dataa=[
			'userid'=>session('user_id'),
			'follow_id'=>$uid,
		];

		$datab=[
			'userid'=>$uid,
			'fans_id'=>session('user_id'),
		];
		$rel=relationModel::get($dataa);
		if($rel!=null){
			echo json_encode(array('status'=>1,'msg'=>'你已经关注TA了哦！'));
		}else{

			Db::startTrans();
			try {
			    Db::name('relation')->insert($dataa);
			    Db::name('relation')->insert($datab);
			    // 提交事务
			    Db::commit();
			} catch (\Exception $e) {
			    // 回滚事务
			    Db::rollback();
			}

			$rela=relationModel::get($dataa);
			if($rela!=null){
				Db::name('user')->where('id',session('user_id'))->setInc('cares');
				Db::name('user')->where('id',$uid)->setInc('fans');
				echo json_encode(array('status'=>2,'msg'=>'关注成功！'));
			}else{
				echo json_encode(array('status'=>3,'msg'=>'关注失败？？'));
			}

		}
		
	}

	//异步发表评论
	public function comment()
	{
		if(!request()->isAjax()){
			$this->errer("页面不存在");
		}
		
		$data=[

          'user_id'   => session('user_id'),
          'weibo_id' => input('wid'),
          'content'  => input('content'),
          'time'  => time()
		]; 
		$row=Db::name('user')->where('id',session('user_id'))->find();
		
		if(Db::name('comment')->insert($data)){
			Db::name('weibo')->where('id',input('wid'))->setInc('comment');
			$str='';
			$str.='<div class="discuss">';
	        $str.='<img src="';
	        $str.='http://localhost/myweibo/uploads';
			$str.='/'.$row['photo'].'" />';
	        $str.='<p>'.$row['name'].':&nbsp;&nbsp;'.input('content').'</p>';  
	        $str.='</div>';      
	        echo $str;
		}else{
			echo "false";
		}
	}

	

	
}