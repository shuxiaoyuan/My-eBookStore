<?php

/* 防止 URL 路径访问以及已经登录的用户访问 */

if(!defined('ENTRY') || isset($_SESSION['user_name']) || isset($_SESSION['admin_name'])) {
    
    header("Location:../../../../index.php");
    
    exit;
    
}

?>
<script>
    /**
     
     * 简单的注册表单验证，只判断了两次输入的密码是否一致
     
     * 其他诸如密码长度、字符类型等判定后期可以用 jQuery 等重写

     */
    function passwordValidate() {
        var register_password = document.forms["form_register"]["register_password"].value;
        var check_password = document.forms["form_register"]["check_password"].value;
        if(register_password == check_password) {
            //alert("注册成功！");
            return true;
        }
        else {
            alert("两次输入的密码不一致！");
            // 清空表单内容
            document.forms["form_register"]["register_password"].value = "";
            document.forms["form_register"]["check_password"].value = "";
            return false;
        }
    }
    
    
    /* 检查用户名是否已经被注册 */
    
    $(document).ready(function() {
        // 用户名不为空且用户名输入框失去焦点
        $("#input_register_username").blur(function() {
            if($("#input_register_username").val() !== '') {
                // 用 Ajax 技术从服务器获取此用户名信息
                $.post(
                    '<?php echo DOMAIN . "index.php?c=guest&a=hasuser"; ?>',
                    {
                        username : $("#input_register_username").val()
                    },
                    function(result) {
                        if(result === "true") { // 存在此用户
                            $("#div_check_username").html("<span class='glyphicon glyphicon-remove text-danger' style='font-size:10px;'>&nbsp;此用户名已被占用！</span>");
                        }
                        else {
                            $("#div_check_username").html("<span class='glyphicon glyphicon-ok text-success' style='font-size:10px;'>&nbsp;此用户名可以使用！</span>");
                        }
                });
            }
        });
    });
    
  </script>
