<?php

/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $book[FIELD_BOOK_NAME]; ?></title>
  <?php include VIEW_PUBLIC_PATH . "style.php"; ?>
</head>
<body  background='<?php echo DOMAIN . "public/images/about/aboutBookStore/bg.jpg";?>'>
  <?php include VIEW_PUBLIC_PATH . "navigation.php"; ?>
  <div id="main" class="container">
    <div class="col-xs-6 col-md-3">
      <img src="<?php echo DOMAIN . $book[FIELD_BOOK_COVER]; ?>" class="img-responsive" alt="<?php echo $book[FIELD_BOOK_NAME]; ?>" />
    </div>
    <div class="col-xs-6 col-md-4">
      <h3><?php echo $book[FIELD_BOOK_NAME]; ?></h3>
      <h5>作者：<?php echo $book[FIELD_BOOK_AUTHOR]; ?></h5>
      <h5>售价：<?php echo $book[FIELD_BOOK_PRICE]; ?></h5>
      <h5>出版社：<?php echo $book[FIELD_BOOK_PUBLISHER]; ?></h5>
      <h5>出版时间：<?php echo $book[FIELD_BOOK_DATE]; ?></h5>
      <h5>ISBN：<?php echo $book[FIELD_BOOK_ISBN]; ?></h5>
      <h5>库存：<?php echo $book[FIELD_BOOK_AMOUNT]; ?></h5>
      <a id="a_buy" href="javascript:void(0);" class="btn btn-primary" role="button">立即购买</a> 
      <a id="a_add" href="javascript:void(0);" class="btn btn-default" role="button">加入书架</a>
    </div>
    <div class="col-xs-12">
      <br /><hr /><br />
      <p><?php echo $book[FIELD_BOOK_INTRO]; ?></p>
    </div>
    <?php include VIEW_PUBLIC_PATH. "footer.php"; ?>
  </div>
  <?php include VIEW_PUBLIC_PATH . "js.php"; ?>
</body>
</html>