<?php

/* 防止 URL 路径访问和不是管理员的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['admin_name'])) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>
<!-- 新书上架 -->
<form action='' method="post" id="form_newbook" class="form-horizontal" role="form" enctype="multipart/form-data">
  <div class="form-group">
    <label for="input_newbook_isbn" class="col-xs-2 col-xs-offset-2 control-label">ISBN</label>
    <div class="col-xs-5 col-sm-4 col-md-3">
      <input type="text" id="input_newbook_isbn" name="newbook_isbn" class="form-control" placeholder="ISBN" required autocomplete="off" />
    </div>
  </div>
  <div class="form-group">
    <label for="input_newbook_name" class="col-xs-2 col-xs-offset-2 control-label">书名</label>
    <div class="col-xs-5 col-sm-4 col-md-3">
      <input type="text" id="input_newbook_name" name="newbook_name" class="form-control" placeholder="图书名称" required autocomplete="off" />
    </div>
  </div>
  <div class="form-group">
    <label for="input_newbook_type" class="col-xs-2 col-xs-offset-2 control-label">类型</label>
    <div class="col-xs-5 col-sm-4 col-md-3">
      <select id="input_newbook_type" name="newbook_type" class="form-control">
        <option></option>
        <option>IT</option>
        <option>English</option>
        <option>else</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="input_newbook_author" class="col-xs-2 col-xs-offset-2 control-label">作者</label>
    <div class="col-xs-5 col-sm-4 col-md-3">
      <input type="text" id="input_newbook_author" name="newbook_author" class="form-control" placeholder="作者" required autocomplete="off" />
    </div>
  </div>
  <div class="form-group">
    <label for="input_newbook_cost" class="col-xs-2 col-xs-offset-2 control-label">成本</label>
    <div class="col-xs-5 col-sm-4 col-md-3">
      <input type="text" id="input_newbook_cost" name="newbook_cost" class="form-control" placeholder="成本" required autocomplete="off" />
    </div>
  </div>
  <div class="form-group">
    <label for="input_newbook_price" class="col-xs-2 col-xs-offset-2 control-label">售价</label>
    <div class="col-xs-5 col-sm-4 col-md-3">
      <input type="text" id="input_newbook_price" name="newbook_price" class="form-control" placeholder="售价" required autocomplete="off" />
    </div>
  </div>
  <div class="form-group">
    <label for="input_newbook_publisher" class="col-xs-2 col-xs-offset-2 control-label">出版社</label>
    <div class="col-xs-5 col-sm-4 col-md-3">
      <input type="text" id="input_newbook_publisher" name="newbook_publisher" class="form-control" placeholder="出版社" required autocomplete="off" />
    </div>
  </div>
  <div class="form-group">
    <label for="input_newbook_date" class="col-xs-2 col-xs-offset-2 control-label">出版时间</label>
    <div class="col-xs-5 col-sm-4 col-md-3">
      <input type="date" id="input_newbook_date" name="newbook_date" class="form-control" placeholder="出版时间" required autocomplete="off" />
    </div>
  </div>
  <div class="form-group">
    <label for="input_newbook_amount" class="col-xs-2 col-xs-offset-2 control-label">上架数量</label>
    <div class="col-xs-5 col-sm-4 col-md-3">
      <input type="number" min="1" value="1" id="input_newbook_amount" name="newbook_amount" class="form-control" placeholder="上架数量" required autocomplete="off" />
    </div>
  </div>
  <div class="form-group">
    <label for="input_newbook_cover" class="col-xs-2 col-xs-offset-2 control-label">封面</label>
    <div class="col-xs-5 col-sm-4 col-md-3">
      <input type="file" id="input_newbook_cover" name="newbook_cover" value="上传图片" required autocomplete="off" />
    </div>
  </div>
  <div class="form-group">
    <label for="textarea_newbook_intro" class="col-xs-2 col-xs-offset-2 control-label">简介</label>
    <div class="col-xs-5 col-sm-4 col-md-3">
      <textarea class="form-control" id="textarea_newbook_intro" name="newbook_intro" rows="3" placeholder="请输入图书简介。"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-xs-2 col-xs-offset-4">
      <button id="button_add_newbook" type="submit" class="btn btn-primary">上架</button>
    </div>
  </div>
</form>