<?php

/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../../../index.php");
    
    exit;
    
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>关于我们</title>
  <?php include VIEW_PUBLIC_PATH . "style.php"; ?>
</head>
<body>
  <?php include VIEW_PUBLIC_PATH . "navigation.php"; ?>
  <div id="main" class="container">
    <div id="header">
      <h1 class="text-center" style="font-family:Consolas;">My-eBookStoreTeam</h1>
    </div>
    <div class="row">
      <div class="col-xs-2 col-xs-offset-1">
        <img src='<?php echo DOMAIN . "public/images/about/aboutus/MZX.jpg";?>' class="img-responsive img-circle" alt="LK" />
      </div>
      <div class="col-xs-2">
        <img src='<?php echo DOMAIN . "public/images/about/aboutus/WD.jpg";?>' class="img-responsive img-circle" alt="LK" />
      </div>
      <div class="col-xs-2">
        <img src='<?php echo DOMAIN . "public/images/about/aboutus/LK.jpg";?>' class="img-responsive img-circle" alt="LK" />
      </div>
      <div class="col-xs-2">
        <img src='<?php echo DOMAIN . "public/images/about/aboutus/LDX.jpg";?>' class="img-responsive img-circle" alt="LK" />
      </div>
      <div class="col-xs-2">
        <img src='<?php echo DOMAIN . "public/images/about/aboutus/LSY.jpg";?>' class="img-responsive img-circle" alt="LK" />
      </div>
    </div>
    <div class="row">
      <div class="col-xs-2 col-xs-offset-1">
        <img src='<?php echo DOMAIN . "public/images/about/aboutus/MZX.png";?>' class="img-responsive img-circle" alt="LK" />
      </div>
      <div class="col-xs-2">
        <img src='<?php echo DOMAIN . "public/images/about/aboutus/WD.png";?>' class="img-responsive img-circle" alt="LK" />
      </div>
      <div class="col-xs-2">
        <img src='<?php echo DOMAIN . "public/images/about/aboutus/LK.png";?>' class="img-responsive img-circle" alt="LK" />
      </div>
      <div class="col-xs-2" style="bottom:15px;">
        <img src='<?php echo DOMAIN . "public/images/about/aboutus/LDX.png";?>' class="img-responsive img-circle" alt="LK" />
      </div>
      <div class="col-xs-2" style="bottom:25px;">
        <img src='<?php echo DOMAIN . "public/images/about/aboutus/LSY.png";?>' class="img-responsive img-circle" alt="LK" />
      </div>
    </div>
    <div class="row">
      <div class="col-xs-2 col-xs-offset-1">
        <p class="text-center text-primary" style="font-family:华文新魏; font-size:20px;">算法支持</p>
      </div>
      <div class="col-xs-2">
        <p class="text-center text-danger" style="font-family:华文新魏; font-size:20px;">网页设计</p>
      </div>
      <div class="col-xs-2">
        <p class="text-center text-warning" style="font-family:华文新魏; font-size:20px;">系统建模</p>
      </div>
      <div class="col-xs-2">
        <p class="text-center text-success" style="font-family:华文新魏; font-size:20px;">测试&文档</p>
      </div>
      <div class="col-xs-2">
        <p class="text-center text-muted" style="font-family:华文新魏; font-size:20px;">全栈开发</p>
      </div>
    </div>
    <div class="row" style="padding-top:50px;">
      <div class="col-xs-12">
        <p class="text-right text-muted" style="font-family:华文新魏; font-size:20px;">My-eBookStore开发小组</p>
      </div>    
    </div>
    <div class="row">
      <div class="col-xs-12">
        <p class="text-right text-muted" style="font-family:华文新魏; font-size:20px; margin-right:20px;">敬上</p>
      </div>    
    </div>
  </div>
  <?php include VIEW_PUBLIC_PATH . "js.php"; ?>
</body>
</html>