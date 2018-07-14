<?php

/* 防止 URL 路径访问和不是管理员的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['admin_name'])) {
    
    header("Location:../../../../index.php");
    
    exit;
    
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>管理员主页</title>
  <?php include VIEW_PUBLIC_PATH . "style.php"; ?>
</head>
<body>
  <?php include VIEW_PUBLIC_PATH . "navigation.php"; ?>
  <div class="container-fluid" id="main">
    <div class="span2  col-xs-12 col-sm-2 col-md-2" style="margin-right:30px; font-family:; font-size:16px;">
      <ul class="nav nav-pills nav-stacked " >
        <li class="left_nav" id="li_order"><a id="order_manage" href="javascript:void(0);">订单管理</a></li>
        <li class="left_nav" id="li_sale"><a id="sale_manage" href="javascript:void(0);">销售管理</a></li>
        <li class="left_nav" id="li_book"><a id="book_manage" href="javascript:void(0);">图书管理</a></li>
        <li class="left_nav" id="li_message"><a id="message_manage" href="javascript:void(0);">留言管理</a></li>
        <li class="left_nav" id="li_user"><a id="user_manage" href="javascript:void(0);">用户管理</a></li>
        <li class="left_nav" id="li_admin"><a id="admin_manage" href="javascript:void(0);">个人设置</a></li>
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
  <?php include VIEW_ADMIN_PATH . "manage/manage.js.php"; ?>
</body>
</html>