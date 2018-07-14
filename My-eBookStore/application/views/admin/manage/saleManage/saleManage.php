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
      <li class="right_nav" id="li_today_sale"><a href="javascript:void(0);">日销售额</a></li>
    </ul>
  </div>
</div>

<!-- 营业信息表 -->
<div id="sale_infor" class="row">

</div>

<!-- 加载本页所需的 js  -->
<?php include VIEW_ADMIN_PATH . "manage/saleManage/saleManage.js.php"; ?>
