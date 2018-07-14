<?php

/* 防止 URL 路径访问和没有登录的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['user_name']) ) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>

<!-- 密码修改 -->
<div class="col-xs-offset-4" style="padding-bottom:20px">
<h3>密码修改</h3>
</div>
<form action='<?php echo DOMAIN . "index.php?c=user&a=editpassword"; ?>' method="post" id="form_edit_password" onsubmit="return editPassword()" class="form-horizontal" role="form">
  <div class="form-group">
    <label for="old_password" class="col-xs-2 col-xs-offset-2 control-label">原始密码</label>
    <div class="col-xs-5 col-sm-4 col-md-3">
      <input type="password" id="input_old_password" name="old_password" class="form-control" placeholder="原始密码" required autocomplete="off" />
    </div>
  </div>
  <div class="form-group">
    <label for="new_password" class="col-xs-2 col-xs-offset-2 control-label">新密码</label>
    <div class="col-xs-5 col-sm-4 col-md-3">
      <input type="password" id="input_new_password" name="new_password" class="form-control" placeholder="新密码" required autocomplete="off" />
    </div>
  </div>
  <div class="form-group">
    <label for="check_password" class="col-xs-2 col-xs-offset-2 control-label">确认密码</label>
    <div class="col-xs-5 col-sm-4 col-md-3">
      <input type="password" id="input_check_password" name="check_password" class="form-control" placeholder="确认密码" required autocomplete="off" />
    </div>
  </div>
  <div class="form-group">
    <div class="col-xs-2 col-xs-offset-4">
      <button id="button_edit_password" type="submit" class="btn btn-primary">提交</button>
    </div>
  </div>
</form>
