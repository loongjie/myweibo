<?php /*a:4:{s:67:"G:\wamp64\www\myweibo\application\index\view\userfans\userfans.html";i:1524928549;s:61:"G:\wamp64\www\myweibo\application\index\view\comm\header.html";i:1525614493;s:65:"G:\wamp64\www\myweibo\application\index\view\comm\userheader.html";i:1524894104;s:63:"G:\wamp64\www\myweibo\application\index\view\comm\userleft.html";i:1524909461;}*/ ?>
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

<div class="user_main">
	<div class="user_content">
		<!--个人信息-->
		<div>
			<div class="user_top" style="background-image: url(/myweibo/uploads/moren/timg4.png);">
				<div class="pf_photo">
					<p class="photo_wrap"><img src="/myweibo/uploads/<?php echo htmlentities($user['photo']); ?>"></p>
				</div>
				<div class="pf_name">
					<h1><?php echo htmlentities($user['name']); ?></h1>
					<?php if(!(in_array($user['id'],$followid)) AND $self!=$user['id']): ?>
					<button type="button" class="btn btn-success" uid="<?php echo htmlentities($user['id']); ?>">关注TA</button>
					<?php endif; ?>
				</div>
				<div class="pf_intro"><?php echo htmlentities((isset($user['note']) && ($user['note'] !== '')?$user['note']:"这家伙很懒，什么也没留下丶")); ?></div>
				<button type="button" class="btn btn-info btn1">更换皮肤</button>    
			</div>
			
			
</div>   
		<!--个人信息-->
		

		<!--主页-->
		<div class="plc_main">
			<div class="wb_left">
				<!--关注，粉丝，微博数-->
				<div class="couter">
					<div class="couter_box">
						<strong class="numb"><?php echo htmlentities($user['cares']); ?></strong>
						<span class="descip"><a href="<?php echo url('index/Usercare/usercare',['id'=>$user['id']]); ?>">关注</a></span>
					</div >
					<div class="couter_box">
						<strong class="numb"><?php echo htmlentities($user['fans']); ?></strong>
						<span class="descip"><a href="<?php echo url('index/Userfans/userfans',['id'=>$user['id']]); ?>">粉丝</a></span>
					</div>
					<div class="couter_box">
						<strong class="numb"><?php echo htmlentities($user['weibonum']); ?></strong>
						<span class="descip">微博</span>
					</div>
				</div>

				<div class="right_top user_bottom">
	            <ul>
	              <li><img src="/myweibo/public/static/image/index.png" /><a href="<?php echo url('index/home/home'); ?>">首页</a></li>
	              <li><img src="/myweibo/public/static/image/comments.png" /><a href="">私信</a></li>
	              <li><img src="/myweibo/public/static/image/favorite.png" /><a href="<?php echo url('mykeep',['id'=>$user['id']]); ?>">收藏</a></li>
	              <?php if($self==$user['id']): ?>
	              <li><img src="/myweibo/public/static/image/me.png" /><a href="<?php echo url('index/Usercenter/index'); ?>">个人信息设置</a>
	              </li>
	              <?php endif; ?>
	              <li><img src="/myweibo/public/static/image/notic.png" /><a href="">其他模块还在建设中~~~</a></li>
	            </ul>
	            </div>
</div>
			<!--左边-->

			<!--右边-->
			<div class="wb_right">
                <!--标题-->
				<div class="right_title">
					<div class="title_weibo">我的微博</div>
					<form>
						<input class="serbtn" type="text" name="" placeholder="搜索我的微博">
						<input class="btn" type="button" name="" value="搜索">
					</form>	
				</div>
				<?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<div class="user_box">
					<div class="user_p"><img src="/myweibo/uploads/<?php echo htmlentities($vo['photo']); ?>"></div>
					<div class="user_j">
						<strong><a href="<?php echo url('index/user/user',['id'=>$vo['id']]); ?>"><?php echo htmlentities($vo['name']); ?></a></strong>
						<p>签名&nbsp;:&nbsp;&nbsp;<?php echo htmlentities((isset($vo['note']) && ($vo['note'] !== '')?$vo['note']:"這家伙很懒，签名都没有")); ?></p>
						<?php if(!in_array($vo['id'],$followid) and $vo['id']!=$self): ?>
						<button class="btn btn-primary btn-sm care" uid=<?php echo htmlentities($vo['id']); ?>>关注</button>
						<?php elseif($vo['id']!=$self): ?>
						<button class="btn btn-primary btn-sm nocare" uid=<?php echo htmlentities($vo['id']); ?>>取消关注</button>
						<?php endif; ?>
					</div>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				<?php echo $res; ?>

			</div>
		</div>
	</div>
<script type="text/javascript">
	var usercareUrl="<?php echo url('index/user/care'); ?>";
	var usernocareUrl="<?php echo url('index/user/nocare'); ?>";
	var careUrl="<?php echo url('index/Home/ralation'); ?>";
</script>
</div>	
