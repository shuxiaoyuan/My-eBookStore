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
  <title>留言反馈</title>
  <?php include VIEW_PUBLIC_PATH . "style.php"; ?>
</head>
<body background='<?php echo DOMAIN . "public/images/about/aboutBookStore/bg.jpg";?>'>
  <?php include VIEW_PUBLIC_PATH . "navigation.php"; ?>
  <div id="main" class="container">
    <h3 class="col-xs-offset-2">添加留言</h3><br />
    <form id="form_message" action="<?php echo DOMAIN . 'index.php?c=user&a=newmessage' ?>" method="post" class="form-horizontal" role="form">
      <div class="form-group">
        <label for="input_message_title" class="col-xs-2 control-label">标题</label>
        <div class="col-xs-8">
          <input type="text" class="form-control" id="input_message_title" name="message_title" placeholder="请输入留言标题" required autocomplete="off" />
        </div>
      </div>
      <div class="form-group">
        <label for="textarea_message_content" class="col-xs-2 control-label">内容</label>
        <div class="col-xs-8">
          <textarea id="textarea_message_content" name="message_content" class="form-control" rows="10" placeholder="请输入留言内容" required autocomplete="off"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
          <button id="button_message_submit" type="submit" class="btn btn-primary">发表</button>
        </div>
      </div>
    </form>
    <br /><h4 class="col-xs-offset-1">最新留言</h4><br />
    <div class="panel panel-primary col-xs-10 col-xs-offset-1" style="padding:0px;">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo $message[FIELD_MESSAGE_TITLE]; ?></h3>
      </div>
      <div class="panel-body">
        <?php echo $message[FIELD_MESSAGE_CONTENT]; ?>
      </div>
      <div class="panel-footer">
        <?php echo $userName; ?>&nbsp;&nbsp;发表于&nbsp;&nbsp;<i><?php echo $message[FIELD_MESSAGE_DATETIME]; ?></i>
      </div>
    </div>
    <?php include VIEW_PUBLIC_PATH. "footer.php"; ?>
  </div>
  <?php include VIEW_PUBLIC_PATH . "js.php"; ?>
  <?php include VIEW_HOME_PATH . "message/message.js.php"; ?>
</body>
</html>