<?php

/* 防止 URL 路径访问和不是管理员的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['admin_name'])) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>

<!-- 营业信息表 -->
<div class="table-responsive">
  <table class="table table-striped col-xs-12">
    <thead>
      <tr>
        <th class="col-xs-4" style="font-size:16px;">
          今日营业情况
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>日销售额：￥ 216</td>
        <td id="td_today_"></td>
      </tr>
      <tr>
        <td>日赢利额：￥ 33</td>
        <td id="td_nickname"></td>
      </tr>
      <tr>
        <td>日销售图书数量：6</td>
        <td id="td_sex"></td>
      </tr>
    </tbody>
  </table>
</div>