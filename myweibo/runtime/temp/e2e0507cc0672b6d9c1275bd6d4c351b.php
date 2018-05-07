<?php /*a:4:{s:59:"G:\wamp64\www\myweibo\application\index\view\home\home.html";i:1525612370;s:61:"G:\wamp64\www\myweibo\application\index\view\comm\header.html";i:1525614493;s:59:"G:\wamp64\www\myweibo\application\index\view\comm\left.html";i:1524839810;s:60:"G:\wamp64\www\myweibo\application\index\view\comm\right.html";i:1524839870;}*/ ?>

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
  <!--main-->
  <div class="home_main">
  	<div class="home_content">

      <!--left-->
  		<div class="left_panel">
  			<img src="/myweibo/public/static/image/home1.png" />
  			<div class="usercontent">
  			<strong class="username"><?php echo session('user_info.name'); ?></strong>
  			<ul>
  				<li class="li1">
  					<a href="">
  						<strong><?php echo htmlentities($user['cares']); ?></strong><br />
  						<span>关注</span>
  					</a>
  				</li>
  				<li class="li1">
  					<a href="">
  						<strong><?php echo htmlentities($user['fans']); ?></strong><br />
  						<span>粉丝</span>
  					</a>
  				</li>
  				<li class="li1">
  					<a href="">
  						<strong><?php echo htmlentities($user['weibonum']); ?></strong><br />
  						<span>微博</span>
  					</a>
  				</li>
  			</ul>
  			</div>
</div>
      
      <!--center-->
  		<div class="center_panel">
        <div class="section_block">
          <form action="<?php echo url('index/Home/postweibo'); ?>" method="post" enctype="multipart/form-data">
            <div class="content1">
              <textarea class="textarea" placeholder="有什么和大家分享的?" name="textarea"></textarea>
              <input class="upload1" type="file" name="image" value="上传图片" /> <br> 
            </div>
              <input type="submit" class="submit1" value="发布" />
          </form>
        </div>

        <div class="titleall">
          <ul>
            <li><a href="<?php echo url('Home/home'); ?>">所有动态</a></li>
            <li><a href="<?php echo url('Home/trends'); ?>">关注动态</a></li>
            <li><a href="<?php echo url('Home/self'); ?>">自己</a></li>
          </ul>
        </div>
        
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
             <?php if(!(in_array($vo['uid'],$followid)) and $self!=$vo['uid']): ?>
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
<!--
                  <div class="discuss">
                    <img src="/myweibo/uploads/"  />
                    <div>
                      <span class="span1"></span><br />
                      <p style="margin-top:5px;"></p>
                      <span class="span2"></span>
                    </div>
                  </div>
-->                
             
                  
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
        <?php echo $weibo; ?>
      </div>
      
  
      <!--right-->
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

















    </div>
  </div>
    
<div>footer</div>
<script type="text/javascript">
  var keepUrl="<?php echo url('index/Home/keep'); ?>";
  var commentUrl="<?php echo url('index/Home/comment'); ?>";
  var careUrl="<?php echo url('index/Home/ralation'); ?>";
  var getcommUrl="<?php echo url('index/Home/getComment'); ?>";
</script>
</body>
</html>