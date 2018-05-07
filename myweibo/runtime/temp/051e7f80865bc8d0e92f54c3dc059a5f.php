<?php /*a:4:{s:59:"G:\wamp64\www\myweibo\application\index\view\user\user.html";i:1525614992;s:61:"G:\wamp64\www\myweibo\application\index\view\comm\header.html";i:1525614493;s:65:"G:\wamp64\www\myweibo\application\index\view\comm\userheader.html";i:1524894104;s:63:"G:\wamp64\www\myweibo\application\index\view\comm\userleft.html";i:1524909461;}*/ ?>
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
				
				<!--微博-->
				<?php foreach($weibo as $key=>$vo): if($vo['isturn'] == 0): ?>
        		<div class="center_main">
             		<div class="main tabmain">
                		<p style="color: #222;"><a href="<?php echo url('User/user',['id'=>$vo['uid']]); ?>"><?php echo htmlentities($vo['name']); ?></a></p>
                		<p style="color: #99a2aa;padding-top: 4px;font-size: 12px;"><?php echo htmlentities(date('Y-m-d H:i',!is_numeric($vo['time'])? strtotime($vo['time']) : $vo['time'])); ?></p>
                		<div style="margin-top: 10px;">
                  		<div><?php echo htmlentities($vo['content']); ?></div>
                  		<?php if($vo["picture"]): ?>
                  		<div style="margin-top:10px;"><img src="/myweibo/uploads/<?php echo htmlentities($vo['picture']); ?>" style="width:240px;height:150px;"></div>
                  		<?php endif; ?>      
                		</div>
                		<ul style="margin-top:10px;padding-bottom:30px;">
                  			<li  onclick="onclick1('tabss<?php echo htmlentities($key); ?>',0);">转发<?php if($vo["turn"]): ?>(<?php echo htmlentities($vo['turn']); ?>)<?php endif; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                  			</li>                 
                  			<li  onclick="onclick1('tabss<?php echo htmlentities($key); ?>',1,<?php echo htmlentities($vo['wbid']); ?>);">
                    		<span class="plbtn" wid="<?php echo htmlentities($vo['wbid']); ?>">评论</span>
                    		<?php if($vo["comment"]): ?>(<?php echo htmlentities($vo['comment']); ?>)<?php endif; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                  			</li>
                  			<span style="cursor: pointer;" class="keep<?php echo htmlentities($key); ?>" onclick="keep(<?php echo htmlentities($vo['wbid']); ?>,'keep<?php echo htmlentities($key); ?>')">收藏</span><?php if($vo["keep"]): ?>(<?php echo htmlentities($vo['keep']); ?>)<?php endif; ?>
                		</ul>
             		</div>
             		<a href="" class="imgtitle" style="background-image:url(/myweibo/uploads/<?php echo htmlentities($vo['photo']); ?>);"></a>
             		<?php if(!(in_array($user['id'],$followid)) and $self!=$vo['uid']): ?>
             		<div class="guanzhu" id="care<?php echo htmlentities($key); ?>" onclick="care(<?php echo htmlentities($vo['uid']); ?>,'care<?php echo htmlentities($key); ?>')"><p>+关注</p></div>
             		<?php endif; ?>
              		<!--选项卡-->
             		<div class="tabs tabss<?php echo htmlentities($key); ?>" >

                		<div class="tab">
                  			<form action="<?php echo url('User/relay',['wbid'=>$vo['wbid']]); ?>" method="post">
                    		<textarea class="turntext" name="turntext" placeholder="转发并表达你的态度"></textarea>
                    		<input type="button" class="sqibtn"  value="收起" onclick="onclick2('tabss<?php echo htmlentities($key); ?>',0);" />
                    		<input type="submit" name="turnsubmit" class="turnsubmit" value="转发">
                  			</form>
                  		<a href="" class="imgtitle1" style="background-image:url(/myweibo/uploads/<?php echo htmlentities($loginphotp); ?>);"></a>
                		</div>
                

                		<div class="tab taab">
                  			<form class="comform" method="post" style="border-bottom: 1px solid #ccc;">
                    		<textarea class="turntext" name="comtext" placeholder="请发表达你的评论"></textarea>
                    		<input type="button" class="sqibtn"  value="收起" onclick="onclick2('tabss<?php echo htmlentities($key); ?>',1);" />
                    		<input type="button" class="turnsubmit comebtn" wid="<?php echo htmlentities($vo['wbid']); ?>" value="评论">
                  			</form>
                  		<a href="" class="imgtitle1" style="background-image:url(/myweibo/uploads/<?php echo htmlentities($loginphotp); ?>);"></a>
                                            
        				</div>
                  
              		<!--选项卡-->  
             		</div>
        		</div>

        
        		<?php endif; if($vo['isturn'] != 0): ?>
        
       			<div class="center_main">
             		<div class="main tabmain">
                	<p style="color: #222;"><a href="<?php echo url('User/user',['id'=>$vo['uid']]); ?>"><?php echo htmlentities($vo['name']); ?></a></p>
                	<p style="color: #99a2aa;padding-top: 4px;font-size: 12px;"><?php echo htmlentities(date('Y-m-d H:i',!is_numeric($vo['time'])? strtotime($vo['time']) : $vo['time'])); ?></p>
                	<div style="margin-top: 10px;">
                  	<div><?php echo htmlentities($vo['content']); ?></div>
                  
                    <!--转发的内容-->
                    	<div class="turncontent">
                        	<div class="turnmain">
                            	<p style="color: #222;"><a href="<?php echo url('index/user/user',['id'=>$vo['isturn']['userid']]); ?>"><?php echo htmlentities($vo['isturn']['name']); ?></a></p>
                              	<p style="color: #99a2aa;padding-top: 4px;font-size: 12px;"><?php echo htmlentities(date('Y-m-d H:i',!is_numeric($vo['isturn']['time'])? strtotime($vo['isturn']['time']) : $vo['isturn']['time'])); ?></p>
                              	<div style="margin-top: 10px;">
                                <div><?php echo htmlentities($vo['isturn']['content']); ?></div>
                                <?php if($vo["isturn"]["picture"]): ?>
                                <div style="margin-top:10px;"><img src="/myweibo/uploads/<?php echo htmlentities($vo['isturn']['picture']); ?>" style="width:240px;height:150px;"></div> 
                                <?php endif; ?>     
                            	</div>

                           	</div>
                           	<a href="" class="imgtitle" style="background-image:url(/myweibo/uploads/<?php echo htmlentities($vo['isturn']['photo']); ?>);"></a>
                        </div>
                 
                    <!--转发的内容-->         
                </div>

                <ul style="margin-top:10px;padding-bottom:30px;">
                	<li  onclick="onclick1('tabss<?php echo htmlentities($key); ?>',0);">
                    转发
                    <?php if($vo["turn"]): ?>(<?php echo htmlentities($vo['turn']); ?>)<?php endif; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                  	</li>                 
                  	<li  onclick="onclick1('tabss<?php echo htmlentities($key); ?>',1,<?php echo htmlentities($vo['wbid']); ?>);">
                    <span class="plbtn" wid="<?php echo htmlentities($vo['wbid']); ?>">评论</span>
                    <?php if($vo["comment"]): ?>(<?php echo htmlentities($vo['comment']); ?>)<?php endif; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                  	</li>
                  	<span style="cursor: pointer;" class="keep<?php echo htmlentities($key); ?>" onclick="keep(<?php echo htmlentities($vo['wbid']); ?>,'keep<?php echo htmlentities($key); ?>')">收藏</span><?php if($vo["keep"]): ?>(<?php echo htmlentities($vo['keep']); ?>)<?php endif; ?>
                </ul>
                </div>
                <a href="" class="imgtitle" style="background-image:url(/myweibo/uploads/<?php echo htmlentities($vo['photo']); ?>);"></a>
                <?php if(!(in_array($user['id'],$followid)) and $self!=$vo['uid']): ?>
             	<div class="guanzhu" id="care<?php echo htmlentities($key); ?>" onclick="care(<?php echo htmlentities($vo['uid']); ?>,'care<?php echo htmlentities($key); ?>')"><p>+关注</p></div>
             	<?php endif; ?>
             	<!--选项卡-->
              	<div class="tabs tabss<?php echo htmlentities($key); ?>" >

	                <div class="tab">
	                  	<form action="<?php echo url('User/relay',['wbid'=>$vo['wbid']]); ?>" method="post">
	                    <textarea class="turntext" name="turntext" placeholder="转发并表达你的态度"></textarea>
	                    <input type="button" class="sqibtn"  value="收起" onclick="onclick2('tabss<?php echo htmlentities($key); ?>',0);" />
	                    <input type="submit" name="turnsubmit" class="turnsubmit" value="转发">
	                  	</form>
	                  	<a href="" class="imgtitle1" style="background-image:url(/myweibo/uploads/<?php echo htmlentities($loginphotp); ?>);"></a>
	                </div>
	                

	                <div class="tab taab">
	                  	<form class="comform" method="post" style="border-bottom: 1px solid #ccc;">
	                    <textarea class="turntext" name="comtext" placeholder="请发表达你的评论"></textarea>
	                    <input type="button" class="sqibtn"  value="收起" onclick="onclick2('tabss<?php echo htmlentities($key); ?>',1);" />
	                    <input type="button" class="turnsubmit comebtn" wid="<?php echo htmlentities($vo['wbid']); ?>" value="评论">
	                  	</form>
	                  	<a href="" class="imgtitle1" style="background-image:url(/myweibo/uploads/<?php echo htmlentities($loginphotp); ?>);"></a>
	                </div>
            	</div>  
              <!--选项卡-->
               

        </div>

         <?php endif; endforeach; ?>
        
			</div>
			<!--右边-->
		</div>
		<!--主页-->
	</div>
</div>


<script type="text/javascript">
	var keepUrl="<?php echo url('index/Home/keep'); ?>";
	var commentUrl="<?php echo url('index/Home/comment'); ?>";
	var careUrl="<?php echo url('index/Home/ralation'); ?>";
	var getcommUrl="<?php echo url('index/Home/getComment'); ?>";
</script>


















