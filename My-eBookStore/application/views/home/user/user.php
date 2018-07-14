 <?php

/* 防止 URL 路径访问和跨权操作 */

if(!defined('ENTRY') || !isset($_SESSION['user_name'])) {
    
    header("Location:../../../../index.php");
    
    exit;
    
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>个人主页</title>
  <?php include VIEW_PUBLIC_PATH . "style.php"; ?>
</head>
<body>
  <?php include VIEW_PUBLIC_PATH . "navigation.php"; ?>
  <div class="container-fluid" id="main">
    <div class="span2  col-xs-12 col-sm-3 col-md-2" style="margin-right:30px; font-family:; font-size:16px;">
      <ul class="nav nav-pills nav-stacked">
        <li class="left_nav" id="li_order"><a id="my_order" href="javascript:void(0);">我的订单</a></li>
        <li class="left_nav" id="li_shelf"><a id="my_shelf" href="javascript:void(0);">我的书架</a></li>
        <li class="left_nav" id="li_message"><a id="my_message" href="javascript:void(0);">我的留言</a></li>
        <li class="left_nav" id="li_account"><a id="my_account" href="javascript:void(0);">我的帐号</a></li>
      </ul>
    </div>
    <div class="col-xs-12 col-sm-8 col-md-9">
      <div id="content" class="row">
        <!-- 这里是 Ajax 动态加载的页面 -->
      </div>
    </div>
    <?php include VIEW_PUBLIC_PATH. "footer.php"; ?>
  </div>
  <?php include VIEW_PUBLIC_PATH . "js.php"; ?>
  <?php include VIEW_HOME_PATH . "/user/user.js.php"; ?>
</body>
</html>