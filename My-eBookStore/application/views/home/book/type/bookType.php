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
  <title><?php echo $type; ?>类书籍</title>
  <?php include VIEW_PUBLIC_PATH . "style.php"; ?>
</head>
<body>
  <?php include VIEW_PUBLIC_PATH . "navigation.php"; ?>
  <div id="main" class="container">
    <div class="modal fade" id="modal_buy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              &times;
            </button>
            <h4 id="modal_book_name" class="modal-title">购买图书</h4>
          </div>
          <div id="order_infor" class="modal-body">
            <form class="form-horizontal" role="form">
              <div class="form-group">
                <label for="modal_book_amount" class="col-xs-3 col-xs-offset-1 control-label">购买数量</label>
                <div class="col-xs-4 col-sm-3">
                  <input type="number" id="modal_book_amount" name="book_amount" class="form-control" value="1" min="1" />
                </div>
                <div class="col-xs-3 col-sm-3" style="top:8px;">
                  <p id="modal_book_total" style="font-size:16px;"></p>
                </div>
              </div>
            </form>
            <p class="text-center">
              总价：￥ <i id="modal_book_cost"></i>
              &nbsp;&nbsp;（余额：<i id="modal_user_balance"></i>）
            </p>
          </div>
          <div class="modal-footer">
            <button id="modal_button_submit" type="button" class="btn btn-primary" data-dismiss="modal">提交订单</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal -->
    </div>
    <div id="book_infor">

    </div>
    <!-- 右边分页栏 -->
    <div class="col-xs-12">
      <div class="col-xs-11 col-xs-offset-1 col-sm-8 col-sm-offset-4 col-md-8 col-md-offset-4">
        <ul class="pagination pagination-md">
          <li class="page" id="li_previous_page"><a id="previous_page" href="javascript:void(0);">&laquo;</a></li>
          <li class="page" id="li_first_page"><a id="first_page" href="javascript:void(0);">首页</a></li>
          <li class="page" id="li_current_page"><a id="current_page" href="javascript:void(0);"></a></li>
          <li class="page" id="li_last_page"><a id="last_page" href="javascript:void(0);">尾页</a></li>
          <li class="page" id="li_next_page"><a id="next_page" href="javascript:void(0);">&raquo;</a></li>
        </ul>
      </div>
    </div>
    <?php include VIEW_PUBLIC_PATH. "footer.php"; ?>
  </div>
  <?php include VIEW_PUBLIC_PATH . "js.php"; ?>
  <?php include VIEW_HOME_PATH . "book/type/bookType.js.php"; ?>
</body>
</html>