<?php

/* 防止 URL 路径访问和没有登录的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['user_name']) ) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>
<!-- 右边导航栏 -->
<div class="row" style="margin-bottom:30px;">
  <div class="col-xs-12 col-sm-12 col-md-12">
    <ul class="nav nav-tabs">
      <li class="right_nav" id="li_profile"><a href="javascript:void(0);">个人信息</a></li>
      <li class="right_nav" id="li_setting"><a href="javascript:void(0);">帐号设置</a></li>
    </ul>
  </div>
</div>

<!-- 用户信息表 -->
<div id="div_my_account" class="row">

</div>

<!-- 加载本页所需的 js  -->
<?php include VIEW_HOME_PATH . "user/myAccount/myAccount.js.php"; ?>