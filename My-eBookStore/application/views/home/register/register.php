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
  <title>用户注册</title>
  <?php include VIEW_PUBLIC_PATH . "style.php"; ?>
</head>
<body>
  <div id="main" class="container">
  <?php include VIEW_PUBLIC_PATH . "navigation.php"; ?>
    <h2 class="text-center">用户注册</h2>
    <hr />
    <form action='<?php echo DOMAIN . "index.php?c=guest&a=register"; ?>' method="post" name="form_register" onsubmit="return passwordValidate()" class="form-horizontal" role="form">
      <div class="form-group">
        <label for="input_register_username" class="col-xs-2 col-xs-offset-2 col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3 control-label">用户名</label>
        <div class="col-xs-5 col-sm-4 col-md-3">
          <input type="text" id="input_register_username" name="register_username" class="form-control" placeholder="用户名" required autocomplete="off" />
        </div>
        <div id="div_check_username" class="col-xs-2 col-sm-2 col-md-2" style="top:5px;">
          <!-- Ajax 判断是否已经存在此用户名 -->
        </div>
      </div>
      <div class="form-group">
        <label for="input_register_password" class="col-xs-2 col-xs-offset-2 col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3 control-label">密&nbsp;&nbsp;&nbsp;码</label>
        <div class="col-xs-5 col-sm-4 col-md-3">
          <input type="password" id="input_register_password" name="register_password" class="form-control" placeholder="密码" required autocomplete="off" />
        </div>
      </div>
      <div class="form-group">
        <label for="input_check_password" class="col-xs-2 col-xs-offset-2 col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3 control-label">确认密码</label>
        <div class="col-xs-5 col-sm-4 col-md-3">
          <input type="password" id="input_check_password" name="check_password" class="form-control" placeholder="确认密码" required autocomplete="off" />
        </div>
      </div>
      <div class="form-group">
        <label for="input_register_nickname" class="col-xs-2 col-xs-offset-2 col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3 control-label">昵称</label>
        <div class="col-xs-5 col-sm-4 col-md-3">
          <input type="text" id="input_register_nickname" name="register_nickname" class="form-control" placeholder="昵称" required autocomplete="off" />
        </div>
      </div>
      <div class="form-group">
        <label for="input_register_mobile" class="col-xs-2 col-xs-offset-2 col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3 control-label">手机号</label>
        <div class="col-xs-5 col-sm-4 col-md-3">
          <input type="text" id="input_register_mobile" name="register_mobile" class="form-control" placeholder="手机号" required autocomplete="off" />
        </div>
      </div>
      <div class="form-group">
        <label for="input_register_address" class="col-xs-2 col-xs-offset-2 col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3 control-label">收货地址</label>
        <div class="col-xs-5 col-sm-4 col-md-3">
          <input type="text" id="input_register_address" name="register_address" class="form-control" placeholder="收货地址" required autocomplete="off" />
        </div>
      </div>
      <div class="form-group">
        <label for="input_register_sex" class="col-xs-2 col-xs-offset-2 col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3 control-label">性别</label>
        <div class="col-xs-5 col-sm-4 col-md-3">
          <select id="input_register_sex" name="register_sex" class="form-control">
            <option></option>
            <option>男</option>
            <option>女</option>
            <option>保密</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="checkbox col-xs-4 col-xs-offset-4 col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5">
          <label><input type="checkbox" name="keep_login" checked="checked" />记住密码</label>
        </div>
      </div>
      <div class="form-group">
        <div class="col-xs-2 col-xs-offset-4 col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5">
          <button type="submit" class="btn btn-primary">注册</button>
        </div>
      </div>
    </form>
    <hr />
    <div class="row">
      <p class="text-center">已有帐号？请&nbsp;<a href='<?php echo DOMAIN . "index.php?c=guest&a=loginview"; ?>' target="_top">登录</a></p>
    </div>
    <?php include VIEW_PUBLIC_PATH . "footer.php"; ?>
  </div>
  <?php include VIEW_PUBLIC_PATH . "js.php"; ?>
  <?php include VIEW_HOME_PATH . "register/register.js.php"; ?>
</body>
</html>