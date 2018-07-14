<?php

/* 防止 URL 路径访问和不是管理员的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['admin_name'])) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>

<!-- 右边导航栏 -->
<div class="row" style="margin-bottom:30px;">
  <div class="col-xs-12 col-sm-12 col-md-12">
    <ul class="nav nav-tabs">
      <li class="right_nav" id="li_all_user"><a href="javascript:void(0);">所有用户</a></li>
    </ul>
  </div>
</div>

<!-- 右边搜索框 -->
<div class="row" style="margin-bottom:20px;">
  <input id="input_username" type="text"  placeholder="输入用户名搜索用户" />
  <button id="search_user" type="button" class="btn btn-sm">搜索</button>
</div>

<!-- 用户信息表 -->
<div id="user_infor" class="row">

</div>

<!-- 右边分页栏 -->
<div class="row">
  <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
    <ul class="pagination pagination-md">
      <li class="page" id="li_previous_page"><a id="previous_page" href="javascript:void(0);">&laquo;</a></li>
      <li class="page" id="li_first_page"><a id="first_page" href="javascript:void(0);">首页</a></li>
      <li class="page" id="li_current_page"><a id="current_page" href="javascript:void(0);"></a></li>
      <li class="page" id="li_last_page"><a id="last_page" href="javascript:void(0);">尾页</a></li>
      <li class="page" id="li_next_page"><a id="next_page" href="javascript:void(0);">&raquo;</a></li>
    </ul>
  </div>
</div>

<!-- 加载本页所需的 js  -->
<?php include VIEW_ADMIN_PATH . "manage/userManage/userManage.js.php"; ?>
