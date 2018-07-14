<?php

/* 防止 URL 路径访问和没有登录的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['user_name']) ) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>
<script>
  
    $(document).ready(function() {
        
        // 本用户的主键
        var pk = "<?php echo $userPK; ?>";
        
        // 本用户的用户名
        var user_name = "<?php echo $_SESSION['user_name']; ?>";
        
        // 设置默认导航标签
        var nav = "profile";
        
        
        /* 右边导航栏 */
        
        // 默认加载第一个导航标签
        loadNav(nav);
        
        // 根据右边导航标签载入某个页面 并切换 active class
        function loadNav(nav) {
            $(".right_nav").removeClass("active");
            $("#li_" + nav).addClass("active");
            $("#div_my_account").load(
                '<?php echo DOMAIN . "index.php?c=user&a=myaccount"; ?>',
                {
                    type : nav,
                    username : user_name
                }
            );
        }
        
        // 点击个人信息导航标签
        $("#li_profile").click(function() {
            loadNav("profile");
        });
        
        $("#li_setting").click(function() {
            loadNav("setting");
        });
        
        /* 个人信息导航标签页 */
        
        // 编辑用户信息的操作 包括保存和取消动作 动态绑定事件
        $("#div_my_account").on('click', '#button_edit_profile', function() {
            
            // 暂存编辑按钮
            var button_edit = '<button id="button_edit_profile" class="btn btn-primary">编辑信息</button>';
            
            // 原来表格中的用户信息用变量暂存
            var nickname = $("#td_nickname").text();
            var mobile = $("#td_mobile").text();
            var address = $("#td_address").text();
            
            // 性别比较特殊，需要判定
            var sex_option1 = $("#td_sex").text() === '' ? "<option selected></option>" : "<option></option>"; 
            var sex_option2 = $("#td_sex").text() === "男" ? "<option selected>男</option>" : "<option>男</option>"; 
            var sex_option3 = $("#td_sex").text() === "女" ? "<option selected>女</option>" : "<option>女</option>";
            var sex_option4 = $("#td_sex").text() === "保密" ? "<option selected>保密</option>" : "<option>保密</option>";
            
            // 生成输入框，初始值为原来的值
            $("#td_nickname").html("<input id='input_nickname' type='text' size='20' value='" + nickname + "' />");
            $("#td_mobile").html("<input id='input_mobile' type='text' size='20' value='" + mobile + "' />");
            $("#td_address").html("<input id='input_address' type='text' size='50' value='" + address + "' />");
            
            // 性别不是普通文本框
            $("#td_sex").html(
                "<select id=input_sex>" +
                   sex_option1 +
                   sex_option2 +
                   sex_option3 +
                   sex_option4 +
                "</select>"
            );
            
            // 在原先编辑和删除的位置生成一个 button_save 按钮类 和 button_cancel 按钮类
            var button_save = $("<button type='button' id='button_save' class='btn btn-primary'>保存</button>");
            var button_cancel = $("<button type='button' id='button_cancel' class='btn btn-primary'>取消</button>");
            $("#div_edit_profile").html(button_save);
            $("#div_edit_profile").append("&nbsp;&nbsp;");
            $("#div_edit_profile").append(button_cancel);
            
            /* 点击取消按钮 还原回原来的数据 */
            
            button_cancel.click(function() {
                $("#td_nickname").html(nickname);
                $("#td_mobile").html(mobile);
                $("#td_address").html(address);
                var sex = ''; // 默认为空
                if(sex_option2 === "<option selected>男</option>") {
                    sex = "男"
                }
                if(sex_option3 === "<option selected>女</option>") {
                    sex = "女"
                }
                if(sex_option4 === "<option selected>保密</option>") {
                    sex = "保密"
                }
                $("#td_sex").html(sex); // 填充性别
                
                // 把保存和取消按钮换回编辑和删除
                $("#div_edit_profile").html(button_edit);
                
            });
            
            /* 点击保存按钮 向服务器提交修改后的数据 */
            button_save.click(function() {
                $.post(
                    '<?php echo DOMAIN . "index.php?c=user&a=edituserinfor"; ?>',
                    {
                        edit_pk : pk,
                        edit_nickname : $("#input_nickname").val(),
                        edit_mobile : $("#input_mobile").val(),
                        edit_address : $("#input_address").val(),
                        edit_sex : $("#input_sex").val()
                    },
                    function(result) {
                        if(result !== "true") {
                            alert(result);
                        }
                        // 保存成功与否，重新载入原来页面
                        loadNav(nav);
                });
            });
            
        });
        
        /* 账号设置导航标签页 */
        
        // 点击提交修改密码 动态绑定事件
        $("#div_my_account").on('submit', '#form_edit_password', function() {
            if($("#input_new_password").val() === $("#input_check_password").val()) {
                return true;
            }
            else {
                alert("两次输入的密码不一致！");
                $("#input_new_password").val("");
                $("#input_check_password").val("");
                return false;
            }
        });
        
    });
      
</script>