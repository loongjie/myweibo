<?php /*a:1:{s:67:"G:\wamp64\www\myweibo\application\index\view\register\register.html";i:1525586064;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<title>微博注册</title>
	<link rel="stylesheet" type="text/css" href="/myweibo/public/static/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/myweibo/public/static/css/register.css">

	<script type="text/javascript" src="/myweibo/public/static/lib/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="/myweibo/public/static/css/register.js"></script>
</head>
<body>
    <div class="logo"><img src="/myweibo/public/static/image/registerlog.png"></div>
    <div class="box">
    	<div class="main">
    		<h2>微&nbsp;&nbsp;&nbsp;博&nbsp;&nbsp;&nbsp;注&nbsp;&nbsp;&nbsp;册</h2>
		    <form class="form-horizontal" action="<?php echo url('index/Register/checkreg'); ?>" method="post">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
              <div class="col-sm-10">
                <input type="text" class="form-control " id="name"  name="name" />
              </div>
              <span class="error errorname"></span>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label" >设置密码</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="psw"  name="password" />
              </div>
			   <span class="error errorpsw"></span>               
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label" >确认密码</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="psww"  name="tpassword" />
              </div>
              <span class="error errorpsww"></span>
            </div>
           <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label" >电子邮箱</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email"  name="email" />
              </div>
              <span class="error erroreml"></span>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label" >验证码</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="varify" name="varify">
              </div>
              <span class="error errorvar"></span>
            </div>
            <img src="<?php echo captcha_src(); ?>" alt="captcha" onclick="this.src='<?php echo captcha_src(); ?>'+Math.random()" />

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" id="submit" name="login">注册</button>
              </div>
            </div>
          </form>
    		<p class="tis">已有账号,<a href="<?php echo url('index/Index/index'); ?>">直接登陆&gt;&gt;</a></p>
    	</div>
    </div>

<script type="text/javascript">
	
	var checkname="<?php echo url('index/Register/checkname'); ?>";
	var checkvarify="<?php echo url('index/Register/checkvarify'); ?>";
</script>

</body>
</html>