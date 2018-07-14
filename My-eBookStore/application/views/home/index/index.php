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
  <?php include VIEW_HOME_PATH . "index/book_3d.css.php"; ?>
</head>
<body>
  <?php include VIEW_PUBLIC_PATH . "navigation.php"; ?>
  <div class="jumbotron">
    <div class="container">
      <div style="padding-top:30px;">
        <h1 class="text-center">My-eBookStore，在此</h1>
      </div>
      <p class="text-center">简洁，安静，优雅。</p>
      <p class="text-center">
        <a href='<?php echo DOMAIN . "index.php?c=view&a=aboutbookstore";?>' title="书店简介" target="_top">进一步了解 >></a>
      </p>
    </div>
  </div>
  <div id="main" class="container">
    <div class="photo_box trans5">
      <div class="rotate_box">
        <div class="img img1">
          <img src='<?php echo DOMAIN . "public/images/index/001.jpeg";?>' />
        </div>
        <div class="img img2">
          <img src='<?php echo DOMAIN . "public/images/index/002.jpeg";?>' />
        </div>
        <div class="img img3">
          <img src='<?php echo DOMAIN . "public/images/index/003.jpeg";?>' />
        </div>
        <div class="img img4">
          <img src='<?php echo DOMAIN . "public/images/index/004.jpg";?>' />
        </div>
        <div class="img img5">
          <img src='<?php echo DOMAIN . "public/images/index/005.jpeg";?>' />
        </div>
        <div class="img img6">
          <img src='<?php echo DOMAIN . "public/images/index/006.jpeg";?>' />
        </div>
      </div>
    </div>
    <?php include VIEW_PUBLIC_PATH. "footer.php"; ?>
  </div>
  <?php include VIEW_PUBLIC_PATH . "js.php"; ?>
</body>
</html>