<?php /*a:1:{s:61:"G:\wamp64\www\myweibo\application\index\view\index\index.html";i:1525596113;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="initial-scale=1,minimum-scale=1" />
  <meta content="随时随地发现新鲜事！微博带你欣赏世界上每一个精彩瞬间，了解每一个幕后故事。分享你想表达的，让全世界都能听到你的心声！" name="description" />
  <title>微博-登陆</title>
  <link rel="stylesheet" type="text/css" href="/myweibo/public/static/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/myweibo/public/static/css/index.css">
  <script type="text/javascript" src="/myweibo/public/static/lib/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="/myweibo/public/static/css/login.js"></script>
</head>
<body>
    <div class="logo"><img src="/myweibo/public/static/image/registerlog.png"></div>
    <div class="box">
      <div class="main">
        <p class="p1">账&nbsp;&nbsp;&nbsp;号&nbsp;&nbsp;&nbsp;登&nbsp;&nbsp;&nbsp;陆</p>
          
          <form class="form-horizontal" action="<?php echo url('index/Index/checkLogin'); ?>" method="post">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="username"  name="user"  placeholder=""><span style="color:red"></span>
              </div>
              
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label" >密码</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="psw"  name="password" placeholder=""><span style="color:red"></span>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label" >验证码</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="varify" name="varify">
                <span style="color:red"></span>
              </div>
            </div>
            <img src="<?php echo captcha_src(); ?>" alt="captcha" onclick="this.src='<?php echo captcha_src(); ?>'+Math.random()" />

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="online"> 记住我
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default " id="btn" name="login">登陆</button>
              </div>
            </div>
          </form>

          <p class="">还没有微博？<a href="<?php echo url('index/Register/register'); ?>" style="color:#ff8140;">立即注册！</a></p>
    </div>

    <script type="text/javascript">
      var checkname="<?php echo url('index/index/checkusername'); ?>";
      var checkpsw="<?php echo url('index/index/checkpsw'); ?>";
      var checkvrity="<?php echo url('index/index/checkvrity'); ?>";
    </script>

</body>
</html>