<?php

/* 防止 URL 路径访问和不是管理员的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['admin_name'])) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>

<!-- 用户信息表 -->
<div class="table-responsive">
  <table class="table table-striped">
    <caption><?php echo "共有" . $inforTotal . "位用户，" . $pageTotal . "页结果"; ?></caption>
    <thead>
      <tr>
        <th>用户名</th>
        <th>昵称</th>
        <th>性别</th>
        <th>手机号</th>
        <th>收货地址</th>
        <th>注册日期</th>
        <th>管理</th>
      </tr>
    </thead>
    <tbody>
<?php

// 遍历由 AccessController 传递过来的用户信息数据数组
foreach($userInfor as $user) {

    echo "
      <tr>
        <td id='td_username_" . $user[FIELD_USER_PK] . "'>" . $user[FIELD_USER_NAME] . "</td>
        <td id='td_nickname_" . $user[FIELD_USER_PK] . "'>" . $user[FIELD_USER_NICKNAME] . "</td>
        <td id='td_sex_" . $user[FIELD_USER_PK] . "'>" . $user[FIELD_USER_SEX] . "</td>
        <td id='td_mobile_" . $user[FIELD_USER_PK] . "'>" . $user[FIELD_USER_MOBILE] . "</td>
        <td id='td_address_" . $user[FIELD_USER_PK] . "'>" . $user[FIELD_USER_ADDRESS] . "</td>
        <td id='td_registertime_" . $user[FIELD_USER_PK] . "'>" . $user[FIELD_USER_REGISTERTIME] . "</td>
        <td id='td_edit_delete_" . $user[FIELD_USER_PK] . "'>
          <a class='a_edit' id='a_edit_" . $user[FIELD_USER_PK] . "' href='javascript:void(0);'>编辑</a>&nbsp;&nbsp;
          <a class='a_delete' id='a_delete_" . $user[FIELD_USER_PK] . "' href='javascript:void(0);'>删除</a>
        </td>
      </tr>";
}

?>
    </tbody>
  </table>
</div>