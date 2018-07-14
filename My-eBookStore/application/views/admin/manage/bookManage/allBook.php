<?php

/* 防止 URL 路径访问和不是管理员的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['admin_name'])) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>

<!-- 这里是图书分页查看信息 -->
<div class="row text-muted" style="margin-bottom:20px; margin-left:10px;">
  <?php echo "共有" . $bookTotal . "本图书，" . $pageTotal . "页结果。"; ?>
</div>
<?php

foreach($books as $book) {
    
    // 对图书简介做截取处理：截取前 20 个字符。
    $len = strlen($book[FIELD_BOOK_INTRO]) < 50 ? strlen($book[FIELD_BOOK_INTRO]) : 50;

    $book[FIELD_BOOK_INTRO] = mb_substr($book[FIELD_BOOK_INTRO], 0, $len, DB_CHARSET);
 
  echo '
    <div id="div_' . $book[FIELD_BOOK_PK] . '" class="col-sm-6 col-md-3">
      <div class="thumbnail book_cover">
        <a href="' . DOMAIN . "index.php?c=view&a=bookdetail&id=" . $book[FIELD_BOOK_ID] . '" target="_blank" title="查看详情页"><img src="' . DOMAIN . $book[FIELD_BOOK_COVER] . '"; alt="' . $book[FIELD_BOOK_NAME] . '" style="width:100px;height:130px" /></a>
      </div>
      <div class="caption">
        <h5 class="book_name">' . $book[FIELD_BOOK_NAME] . '</h5>
        <h6>售价：￥ <em class="book_price">' . $book[FIELD_BOOK_PRICE] . '</em></h6>
        <h6>成本：￥ <em class="book_cost">' . $book[FIELD_BOOK_COST] . '</em></h6>
        <h6>库存：' . $book[FIELD_BOOK_AMOUNT] . '</h6>
        <p class="book_button">
          <a id="edit_' . $book[FIELD_BOOK_PK]  . '" href="javascript:void(0);" class="btn btn-sm btn-primary edit_book" role="button">调整售价</a>
          <a id="delete_' . $book[FIELD_BOOK_PK]  . '" href="javascript:void(0);" class="btn btn-sm btn-default delete_book" role="button">下架此书</a>
        </p>
      </div>
    </div>
  ';
}

?>
