<?php /*a:3:{s:66:"G:\wamp64\www\myweibo\application\index\view\usercenter\index.html";i:1524033644;s:61:"G:\wamp64\www\myweibo\application\index\view\comm\header.html";i:1524838757;s:60:"G:\wamp64\www\myweibo\application\index\view\comm\right.html";i:1524839870;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<title>我的首页</title>
    <script type="text/javascript" src="/myweibo/public/static/lib/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/myweibo/public/static/css/header.js"></script>
    <script type="text/javascript" src="/myweibo/public/static/css/user.js"></script>
    <link rel="stylesheet" type="text/css" href="/myweibo/public/static/css/home.css">
    <link rel="stylesheet" type="text/css" href="/myweibo/public/static/css/usercenter.css">
    <link rel="stylesheet" type="text/css" href="/myweibo/public/static/css/user.css">
    <link rel="stylesheet" type="text/css" href="/myweibo/public/static/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/myweibo/public/static/css/search.css">
</head>
<body>
  <!--top-->
  <div class="top">
  	<div class="top_main">
  		<a href="<?php echo url('index/home/home'); ?>"><img src="/myweibo/public/static/image/logo.png"></a>
  		<form action="<?php echo url('Search/search'); ?>" method="get">
  		<input type="text" name="search" class="search" placeholder="搜人,搜微博" />
  		<input type="submit" name="submit" value="搜一下" style="background: #fa7d3c;color:white;border:none;border-radius: 3px;width:60px;" />
  		</form>
  		<span class="a"><a href="<?php echo url('index/user/user',['id'=>session('user_id')]); ?>">你好！<?php echo session('user_info.name'); ?></a></span>
      <span class="c">&nbsp;&nbsp;||&nbsp;&nbsp;</span>
  		<span class="b"><a href="<?php echo url('index/Home/loginOut'); ?>">注销</a></span>
  	</div>
  </div>
  <div style="clear: both;"></div>
<link rel="stylesheet" type="text/css" href="">
<div class="home_main">
  	<div class="home_content">
      <div class="right_panel">
          <div class="right_top">
            <ul>
              <li><img src="/myweibo/public/static/image/index.png" /><a href="<?php echo url('index/home/home'); ?>">首页</a></li>
              <li><img src="/myweibo/public/static/image/comments.png" /><a href="">私信</a></li>
              <li><img src="/myweibo/public/static/image/favorite.png" /><a href="<?php echo url('index/user/mykeep',['id'=>session('user_id')]); ?>">收藏</a></li>
              <li><img src="/myweibo/public/static/image/me.png" /><a href="<?php echo url('index/Usercenter/index'); ?>">个人信息设置</a>
              </li>
              <li><img src="/myweibo/public/static/image/notic.png" /><a href="#">其他模块还在建设中~~~</a></li>
            </ul>
          </div>
          <div class="right_bottom">
            <h3 style="text-align:center;border-bottom:1px solid #ccc">分组</h3>
            <ul>
              <?php if($listfenzhu!=null): if(is_array($listfenzhu) || $listfenzhu instanceof \think\Collection || $listfenzhu instanceof \think\Paginator): $i = 0; $__LIST__ = $listfenzhu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
              <li><img src="/myweibo/public/static/image/me.png" /><a href="#"><?php echo htmlentities($vo['groupname']); ?></a></li>
              <?php endforeach; endif; else: echo "" ;endif; endif; ?>
              <li><img src="/myweibo/public/static/image/me.png" /><button class="btn btn-primary btn-xs" style="margin-left:7px;" id='create_group'>创建分组</button>  </li>

            </ul>
          </div>

          <!--创建分组-->
<script type="text/javascript">
  var addgroup="<?php echo url('index/Base/addgroup'); ?>";
  var firstindex="<?php echo url('index/home/home'); ?>"
</script>          
<div id="add-group" class="add-group">
  <p>创建好友分组</p>
  <span>分组名称：</span>
  <input type="text" name="name" class="name" id="gp-name"/>
  <div class='gp-btn-wrap'>
    <span class='btn a' id="gpp-add">添加</span>
    <span class='btn b' id="gp-no">取消</span>
  </div>
</div>

</div>

















      <div class="usercenter">
         <div class="usermian">
         	<h2>修改个人信息</h2>
         	<form action="checkuserinfo" method="post" enctype="multipart/form-data">
				  <div class="form-group">
				    <label for="exampleInputEmail1">用户名</label>
				    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email" value="<?php echo htmlentities($result['name']); ?>" name="name">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">密码</label>
				    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="<?php echo htmlentities($result['password']); ?>" name="password">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">邮箱</label>
				    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="email" value="<?php echo htmlentities($result['email']); ?>" name="email">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputFile">上传头像</label>
				    <input type="file" id="exampleInputFile" name="file">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">个性签名</label>
				    <textarea type="password" class="form-control" id="exampleInputPassword1" placeholder="用一句话表达自己" value="<?php echo htmlentities($result['note']); ?>" name="note"></textarea> 
				  </div>
				 
				  <button type="submit" class="btn btn-default">点击提交</button>
            </form>
         </div>	
      </div>

    </div>	
</div>  		


