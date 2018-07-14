<?php

/* 防止 URL 路径访问和没有登录的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['user_name']) ) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>

<!-- 用户信息表 -->
<div class="table-responsive">
  <table class="table table-striped col-xs-12">
    <thead>
      <tr>
        <th class="col-xs-4" style="font-size:16px;">
          账户余额：<?php echo $userInfor[FIELD_USER_BALANCE]; ?>&nbsp;元&nbsp;&nbsp;
          <a id='a_recharge' href='javascript:void(0);' style="font-size:15px;">立即充值</a>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>用户名</td>
        <td id="td_username"><?php echo $userInfor[FIELD_USER_NAME]; ?></td>
      </tr>
      <tr>
        <td>昵称</td>
        <td id="td_nickname"><?php echo $userInfor[FIELD_USER_NICKNAME]; ?></td>
      </tr>
      <tr>
        <td>性别</td>
        <td id="td_sex"><?php echo $userInfor[FIELD_USER_SEX]; ?></td>
      </tr>
      <tr>
        <td>手机号</td>
        <td id="td_mobile"><?php echo $userInfor[FIELD_USER_MOBILE]; ?></td>
      </tr>
      <tr>
        <td>收货地址</td>
        <td id="td_address"><?php echo $userInfor[FIELD_USER_ADDRESS]; ?></td>
      </tr>
    </tbody>
  </table>
</div>
<div id="div_edit_profile">
  <button id="button_edit_profile" type="button" class="btn btn-primary">编辑信息</button>
</div>