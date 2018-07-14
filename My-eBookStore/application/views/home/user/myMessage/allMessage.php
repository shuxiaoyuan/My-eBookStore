<?php

/* 防止 URL 路径访问和没有登录的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['user_name']) ) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>
<!-- 这里是留言分页查看信息 -->
<div class="row text-muted" style="margin-bottom:20px; margin-left:10px;">
  <?php echo "共有" . $messageTotal . "条留言，" . $pageTotal . "页结果。"; ?>
</div>

<?php

foreach($messages as $message) {
    
    echo '
    
        <div class="panel panel-default col-xs-9" style="padding:0px;">
          <div class="panel-heading">
            <h3 class="panel-title"><a class="title" id="title_' . $message[FIELD_MESSAGE_PK] . '" title="点击展开" href="javascript:void(0);">' . $message[FIELD_MESSAGE_TITLE] . '</a></h3>
          </div>
          <div id="content_' . $message[FIELD_MESSAGE_PK] . '" class="panel-body" style="display:none">'
            . $message[FIELD_MESSAGE_CONTENT] . '
          </div>
          <div class="panel-footer">
            <a href="javascript:void(0);">回复</a>&nbsp;&nbsp;
            <a class="reply_toggle" href="javascript:void(0);">展开回复</a>&nbsp;&nbsp;
            <a id="delete_' . $message[FIELD_MESSAGE_PK] . '" class="message_delete" href="javascript:void(0);">删除</a>&nbsp;&nbsp;
            发表于：<i>' . $message[FIELD_MESSAGE_DATETIME] . '</i>
          </div>
        </div>
    
    ';
    
}
