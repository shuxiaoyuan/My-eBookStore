<?php

/* 防止 URL 路径访问和没有登录的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['user_name']) ) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}


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
        <h6>售价：￥ <i class="book_price">' . $book[FIELD_BOOK_PRICE] . '</i></h6>
        <h6>库存：' . $book[FIELD_BOOK_AMOUNT] . '</h6>
        <h6>购买数量：<input type="number" id="book_amount_' . $book[FIELD_BOOK_PK] . '" value="1" min="1"style="width:30%" /></h6>
        <p class="book_button">
          <a id="buy_' . $book[FIELD_BOOK_PK]  . '" href="javascript:void(0);" class="btn btn-sm btn-primary buy_book" role="button" data-toggle="modal" data-target="#modal_buy">立即购买</a>
          <a id="remove_' . $book["shelf_id"]  . '" href="javascript:void(0);" class="btn btn-sm btn-default remove_book" role="button">移出书架</a>
        </p>
        <div id="option_' . $book[FIELD_BOOK_PK] . '" class="col-xs-offset-3 book_option" style="margin-top:20px;">
          <!-- 图书选择字体图标 -->
        </div>
      </div>
    </div>
  ';
}