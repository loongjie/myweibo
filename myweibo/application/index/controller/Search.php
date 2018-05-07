<?php

namespace app\index\controller;
use app\index\model\User as UserModel;
use think\Request;
use think\Db;

class Search extends Base
{
	public function search(Request $request)
	{
		//搜索结果
		$data=$request->param();
        $search=$data['search'];
        $field=array('id','name','photo','cares','fans','weibonum');
        $res=Db::name('user')->where('name','like','%'.$search.'%')->where('id','<>',session('user_id'))->field($field)->paginate(2,false,['query' => request()->param(),]);
 
        
        $this->assign('res',$res);

        
        //分组信息
        $res=Db::name('group')->where('userid',session('user_id'))->select();
        if($res){
            $this->assign('listfenzhu',$res);
        }else{
            $this->assign('listfenzhu',null);
        }
        //搜索信息
		$this->assign('search',$data['search']);

		//查询

		return $this->fetch();
	}


}



