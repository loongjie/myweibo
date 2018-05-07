<?php /*a:3:{s:63:"G:\wamp64\www\myweibo\application\index\view\search\search.html";i:1525614893;s:61:"G:\wamp64\www\myweibo\application\index\view\comm\header.html";i:1525614493;s:60:"G:\wamp64\www\myweibo\application\index\view\comm\right.html";i:1524839870;}*/ ?>
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
  		<input type="text" name="search" class="search" placeholder="搜人" />
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
         	<img  class="searchlog" src="/myweibo/public/static/image/search.png" />

			<form class="searchform" method="get" action="<?php echo url('search'); ?>">
			  <div class="form-group">
			    <input type="text" class="form-control" value="<?php echo htmlentities($search); ?>" name="search">
			  </div>
			  <button type="submit" class="btn btn-default">搜一下</button>
			</form>

			<div class="searli">
				<ul>
					<li><a href="">搜人</a></li>
				</ul>
			</div>
            <?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>  
			<div class="searchpp">
				<img src="/myweibo/uploads/<?php echo htmlentities($vo['photo']); ?>">
				<div class="searchname">
					<span style="color:red;font-size:16px;"><?php echo htmlentities($vo['name']); ?></span><br />
					<span>关注：<?php echo htmlentities($vo['cares']); ?>&nbsp;&nbsp;|&nbsp;&nbsp;粉丝：<?php echo htmlentities($vo['fans']); ?>&nbsp;&nbsp;|&nbsp;&nbsp;微博：<?php echo htmlentities($vo['weibonum']); ?></span>
				</div>
				<div class="btn-group1" role="group">
				    <a href="<?php echo url('index/user/user',['id'=>$vo['id']]); ?>"><button type="button" class="btn btn-default" id="<?php echo htmlentities($vo['name']); ?>">看下Ta</button></a>
				</div>
			</div>
			<?php endforeach; endif; else: echo "" ;endif; ?>
			<?php echo $res; ?>

         </div>	
      </div>

    </div>	
</div>  