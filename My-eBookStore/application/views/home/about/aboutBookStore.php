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
  <title>My-eBookStore</title>
  <?php include VIEW_PUBLIC_PATH . "style.php"; ?>
</head>
<body background='<?php echo DOMAIN . "public/images/about/aboutBookStore/bg.jpg";?>'>
  <?php include VIEW_PUBLIC_PATH . "navigation.php"; ?>
  <div id="main" class="container">
    <div class="row" style="margin-top:20px;">
      <div class="col-xs-12">
        <p class="text-center text-info" style="font-family:华文新魏; font-size:20px;">喜欢简洁、安静、优雅的读书氛围？</p>
      </div>    
    </div>
    <div class="row">
      <div class="col-xs-12">
        <p class="text-center text-info" style="font-family:华文新魏; font-size:20px;">Love simple, quiet and elegant?</p>
      </div>    
    </div>
    <div class="row" style="margin-top:10px;">
      <div class="col-xs-12">
        <p class="text-center text-success" style="font-family:华文新魏; font-size:20px;">我们也是。</p>
      </div>    
    </div>
    <div class="row">
      <div class="col-xs-12">
        <p class="text-center text-success" style="font-family:华文新魏; font-size:20px;">We do too.</p>
      </div>    
    </div>
    <div class="row" style="margin-top:10px;">
      <div class="col-xs-12">
        <p class="text-center text-primary" style="font-family:华文新魏; font-size:20px;">我们给您提供这样一个平台，</p>
      </div>    
    </div>
    <div class="row">
      <div class="col-xs-12">
        <p class="text-center text-primary" style="font-family:华文新魏; font-size:20px;">We provide such a platform for you,</p>
      </div>    
    </div>
    <div class="row" style="margin-top:10px;">
      <div class="col-xs-12">
        <p class="text-center text-danger" style="font-family:华文新魏; font-size:20px;">让您的一身才华，</p>
      </div>    
    </div>
    <div class="row">
      <div class="col-xs-12">
        <p class="text-center text-danger" style="font-family:华文新魏; font-size:20px;">Scintillating with wit as you are,</p>
      </div>    
    </div>
    <div class="row" style="margin-top:10px;">
      <div class="col-xs-12">
        <p class="text-center text-warning" style="font-family:华文新魏; font-size:20px;">一触，即发。</p>
      </div>    
    </div>
    <div class="row">
      <div class="col-xs-12">
        <p class="text-center text-warning" style="font-family:华文新魏; font-size:20px;">More sparking and splendid.</p>
      </div>    
    </div>
    <div class="row" style="margin-top:20px;">
      <div class="col-xs-12">
        <p class="text-right text-muted" style="font-family:华文新魏; font-size:20px;">My-eBookStore&nbsp;&nbsp;&nbsp;&nbsp;</p>
      </div>    
    </div>
    <div class="row">
      <div class="col-xs-12">
        <p class="text-right text-muted" style="font-family:华文新魏; font-size:20px;">方寸之间，乐趣全开。</p>
      </div>    
    </div>
    <?php include VIEW_PUBLIC_PATH. "footer.php"; ?>
  </div>
  <?php include VIEW_PUBLIC_PATH . "js.php"; ?>
</body>
</html>