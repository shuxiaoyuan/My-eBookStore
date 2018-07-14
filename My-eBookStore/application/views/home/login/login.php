<?php

/* 防止 URL 路径访问以及已经登录的用户访问 */

if(!defined('ENTRY') || isset($_SESSION['user_name']) || isset($_SESSION['admin_name'])) {
    
    header("Location:../../../../index.php");
    
    exit;
    
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>用户登录</title>
  <?php include VIEW_PUBLIC_PATH . "style.php"; ?>
</head>
<body>
  <?php include VIEW_PUBLIC_PATH . "navigation.php"; ?>
  <div id="main" class="container">
    <h2 class="text-center" style="padding:20px;">用户登录</h2>
    <hr />
    <form action='<?php echo DOMAIN . "index.php?c=guest&a=login"; ?>' method="post" class="form-horizontal" role="form">
      <div class="form-group">
        <label for="login_username" class="col-xs-2 col-xs-offset-2 col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3 control-label">帐&nbsp;&nbsp;号</label>
        <div class="col-xs-5 col-sm-4 col-md-3">
          <input type="text" id="login_username" name="login_username" class="form-control" placeholder="用户名" required autocomplete="off" />
        </div>
      </div>
      <div class="form-group">
        <label for="login_password" class="col-xs-2 col-xs-offset-2 col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3 control-label">密&nbsp;&nbsp;码</label>
        <div class="col-xs-5 col-sm-4 col-md-3">
          <input type="password" id="login_password" name="login_password" class="form-control" placeholder="密码" required autocomplete="off" />
        </div>
        <div class="col-xs-3 col-sm-3 col-md-2" style="padding-top:6px">
          <a href="javascript:void(0);"><span style="font-size:10px;">忘记密码？</span></a>
        </div>
      </div>
      <div class="form-group">
        <div class="checkbox col-xs-4 col-xs-offset-4 col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5">
          <label><input type="checkbox" name="keep_login" checked="checked" />记住密码</label>
        </div>
      </div>
      <div class="form-group">
        <div class="col-xs-2 col-xs-offset-4 col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5">
          <button type="submit" class="btn btn-primary">登录</button>
        </div>
      </div>
    </form>
    <hr />
    <div class="row">
      <p class="text-center">还没有帐号？请&nbsp;<a href='<?php echo DOMAIN . "index.php?c=guest&a=registerview"; ?>' target="_top">注册</a></p>
    </div>
    <?php include VIEW_PUBLIC_PATH . "footer.php"; ?>
  </div>
  <?php include VIEW_PUBLIC_PATH . "js.php"; ?>
</body>
</html>