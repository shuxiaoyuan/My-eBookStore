<?php

/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>

<div  class="row" style="padding-bottom:10px;">
  <ol class="breadcrumb">
    <li>My-eBookStore</li>
    <li><?php echo $type; ?></li>
    <li class="active"><?php echo $type . "类书籍共有 " . $bookTotal . " 本，" . $pageTotal . " 页结果。"; ?></li>
  </ol>
</div>

<?php

foreach($books as $book) {
  echo '
    <div class="col-sm-6 col-md-3" style="padding-bottom:10px;">
      <div class="thumbnail">
        <a href="' . DOMAIN . 'index.php?c=view&a=bookdetail&id=' . $book[FIELD_BOOK_ID] . '" target="_blank" title="点击查看图书详情页">
          <img src="' . $book[FIELD_BOOK_COVER] . '"; alt="' . $book[FIELD_BOOK_NAME] . '" style="width:150px;height:200px">
        </a>
      </div>
      <div class="caption">
        <h4 id="book_name_' . $book[FIELD_BOOK_PK] . '">' . $book[FIELD_BOOK_NAME] . '</h4>
        <h5>售价：￥ <i id="book_price_' . $book[FIELD_BOOK_PK] . '">' . $book[FIELD_BOOK_PRICE] . '</i></h5>
        <p>作者：' . $book[FIELD_BOOK_AUTHOR] . '</p>
        <p>库存：<i id="book_amount_' . $book[FIELD_BOOK_PK] . '">' . $book[FIELD_BOOK_AMOUNT] . '</i></p>
        <p>
          <a id="buy_' . $book[FIELD_BOOK_PK] . '" href="javascript:void(0);" class="btn btn-primary button_buy" role="button" data-toggle="modal" 
   data-target="#modal_buy">
            立即购买
          </a> 
          <a id="add_' . $book[FIELD_BOOK_PK] . '" href="javascript:void(0);" class="btn btn-default button_add" role="button">
            加入书架
          </a>
        </p>
      </div>
    </div>
  ';
}

