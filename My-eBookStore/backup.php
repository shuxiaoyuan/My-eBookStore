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
        <h3 class="panel-title">留言标题</h3>
      </div>
      <div class="panel-body">
        LSY：《你的孤独 虽败犹荣》是2014年由中信出版社出版的图书，作者是刘同
        本书用33个真实动人的故事，讲述33种形式各异但又直抵内心的孤独。用最温暖的笔触诉说：孤独不是失败，它是自己与自己相处与对话最好的时光。
        此书新书上市仅三个月，销量已突破一百万册，迅速刷新了青春文学的销量纪录。在开学的前夜一个人辗转反侧、猜想新环境；在毕业那天假装潇洒和决绝，拿起行李箱转身的瞬间某种情感喷涌而出；在纷繁的职场，既坚持又妥协，一遍遍问自己“什么才是我想要的”；在复杂的社交中，戴上了假面具、学会了低姿态，却也不忘在另一个平行的世界，那个傲娇倔强的自己。
        书中刘同披露了自己的十年奋斗路，重点关注人生中六个孤独的截面，通过与朋友、恋人、父母之间的相处等等，回味自己33年的成长感悟
      </div>
      <div class="panel-footer">
        <a href="javascript:void(0);">回复</a>&nbsp;&nbsp;
        <a href="javascript:void(0);">查看回复</a>&nbsp;&nbsp;
        <i>2017-07-05 14:07:36</i>
      </div>
      <ul class="list-group">
        <li class="list-group-item">
          LK(管理员)&nbsp;&nbsp;回复&nbsp;&nbsp;LSY(留言者) ：种形式各异但又直抵<br />
          <a href="javascript:void(0);">回复</a>&nbsp;&nbsp;
          <i>2017-07-05 14:18:23</i>
        </li>
        <li class="list-group-item">
          LSY(留言者)&nbsp;&nbsp;回复&nbsp;&nbsp;LK(管理员) ：免费 Window 空间托管<br />
            <a href="javascript:void(0);">回复</a>&nbsp;&nbsp;
            <i>2017-07-05 14:39:12</i>
        </li>
      </ul>
    </div>
    <?php include VIEW_PUBLIC_PATH. "footer.php"; ?>
  </div>
  <?php include VIEW_PUBLIC_PATH . "js.php"; ?>
  <?php include VIEW_HOME_PATH . "message/message.js.php"; ?>
</body>
</html>