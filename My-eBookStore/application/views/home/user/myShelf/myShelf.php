<?php

/* 防止 URL 路径访问和没有登录的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['user_name']) ) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>

<!-- 右边导航栏 -->
<div class="row" style="margin-bottom:30px;">
  <div class="col-xs-12 col-sm-12 col-md-12">
    <ul class="nav nav-tabs">
      <li class="right_nav" id="li_all_book"><a href="javascript:void(0);">所有图书</a></li>
    </ul>
  </div>
</div>

<!-- 模态框 -->
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


<!-- 书架信息 -->
<div id="shelf_infor" class="row">

</div>

<div id="div_shelf_edit" class="row" style="margin-top:50px;">
  <div id="div_shelf_button" class="col-xs-5 col-xs-offset-3">
    <button id="button_edit" type="button" class="btn btn-primary btn-lg btn-block">编辑图书</button>
  </div>
</div>

<!-- 加载本页所需的 js  -->
<?php include VIEW_HOME_PATH . "user/myShelf/myShelf.js.php"; ?>