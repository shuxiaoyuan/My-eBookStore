<?php

/* 防止 URL 路径访问和不是管理员的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['admin_name'])) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>
<script>
  
    $(document).ready(function() {
        
        /* 右边导航栏 */
        
        // 默认为“所有用户”导航标签添加 active 类
        $("#li_all_user").addClass("active");
        
        
        /* 右边搜索框 */
        
        // 根据用户名载入用户信息的函数
        function searchUser() {
            $("#user_infor").load(
                '<?php echo DOMAIN . "index.php?p=admin&c=view&a=usermanage"; ?>',
                {
                    type : "search",
                    search_name : $("#input_username").val()
                }
            );
        }
        
        // 点击搜索按钮
        $("#search_user").click(function() {
            if($("#input_username").val() !== '') { // 确保输入不为空（后台未检验）
                searchUser();
            }
        });
        
        // 在搜索框回车
        $("#input_username").keydown(function(e) {
            var key = e.which;
            if(key == 13 && $("#input_username").val() !== '') { // 回车键是 13
                searchUser();
            }
        });

        
        /* 右边分页栏 */
        
        // 初始化当前页码为 1
        var current_page = 1;
        
        // 初始化尾页页码为 1 每次载入当前页面时会动态获取
        var last_page = 1;
        
        // active 类一直在当前页
        $("#li_current_page").addClass("active");
        
        // 载入当前页面
        loadPage(current_page);
        
        // 根据页码载入某个页面 并切换 active class 和当前显示页码 并更新尾页页码
        function loadPage(page) {
            $("#current_page").text("第" + page + "页");
            $("#user_infor").load(
                '<?php echo DOMAIN . "index.php?p=admin&c=view&a=usermanage"; ?>',
                {
                    type : "page",
                    page : page
                }
            );
            $.post(
                '<?php echo DOMAIN . "index.php?p=admin&c=view&a=getpagetotal"; ?>',
                {
                    type : "user",
                    each : 6
                },
                function(result) {
                    // 字符串转 int 函数 parseInt
                    last_page = parseInt(result);
            });
        }
        
        // 点击上一页
        $("#previous_page").click(function() {
            if(current_page> 1) {
                current_page--;
                loadPage(current_page);
            }
        });
        
        // 点击首页
        $("#first_page").click(function() {
            current_page = 1;
            loadPage(current_page);
        });
        
        // 点击尾页
        $("#last_page").click(function() {
            current_page = last_page;
            loadPage(current_page);
        });
        
        // 点击下一页
        $("#next_page").click(function() {
            if(current_page <= last_page) {
                current_page++;
                loadPage(current_page);
            }
        });
        
        
        /* 右边对用户的具体操作 */
        
        // 删除用户的操作 动态绑定事件
        $("#user_infor").on("click", ".a_delete", function() {
            if(confirm("确认要删除此用户？")) {
                // 本标签的 id 为 delete_ 加上用户主键
                var pk = $(this).attr("id").substring(9);
                $.post(
                    '<?php echo DOMAIN . "index.php?p=admin&c=admin&a=deleteuser"; ?>',
                    {
                        pk : pk
                    },
                    function(result) {
                        if(result !== "true") {
                            alert(result);
                        }
                        // 删除成功与否，重新载入原来页面
                        loadPage(current_page);
                });
            }
        });
        
        
        // 编辑用户信息的操作 包括保存和取消动作 动态绑定事件
        $("#user_infor").on('click', '.a_edit', function() {
            
            // 先还原其它编辑状态按钮，这句竟然实现了。。。
            $(".button_cancel").click();
            
            // 本标签的 id 为 edit_ 加上用户主键
            var pk = $(this).attr("id").substring(7);
            
            // 存储原来的编辑和删除链接
            var a_edit = "<a class='a_edit' id='a_edit_" + pk + "' href='javascript:void(0);'>编辑</a>&nbsp;&nbsp;";
            var a_delete = "<a class='a_delete' id='a_delete_" + pk + "' href='javascript:void(0);'>删除</a>";
            
            // 原来表格中的用户信息用变量暂存
            var nickname = $("#td_nickname_" + pk).text();
            var mobile = $("#td_mobile_" + pk).text();
            var address = $("#td_address_" + pk).text();
            //var registertime = $("#td_registertime_" + pk).text();
            
            // 性别比较特殊，需要判定
            var sex_option1 = $("#td_sex_" + pk).text() === '' ? "<option selected></option>" : "<option></option>"; 
            var sex_option2 = $("#td_sex_" + pk).text() === "男" ? "<option selected>男</option>" : "<option>男</option>"; 
            var sex_option3 = $("#td_sex_" + pk).text() === "女" ? "<option selected>女</option>" : "<option>女</option>";
            var sex_option4 = $("#td_sex_" + pk).text() === "保密" ? "<option selected>保密</option>" : "<option>保密</option>";
            
            // 生成输入框，初始值为原来的值
            // style='width:" + $(this).width() + " height:" + $(this).height() + "'
            $("#td_nickname_" + pk).html("<input id='input_nickname' type='text' size='8' value='" + nickname + "' />");
            $("#td_mobile_" + pk).html("<input id='input_mobile' type='text' size='8' value='" + mobile + "' />");
            $("#td_address_" + pk).html("<input id='input_address' type='text' size='8' value='" + address + "' />");
            
            // 性别不是普通文本框
            $("#td_sex_" + pk).html(
                "<select id=input_sex>" +
                   sex_option1 +
                   sex_option2 +
                   sex_option3 +
                   sex_option4 +
                "</select>"
            );
            
            // 在原先编辑和删除的位置生成一个 button_save 按钮类 和 button_cancel 按钮类
            var button_save = $("<button type='button' id='button_save_" + pk + "' class='button_save btn btn-primary btn-xs'>保存</button>");
            var button_cancel = $("<button type='button' id='button_cancel_" + pk + "' class='button_cancel btn btn-primary btn-xs'>取消</button>");
            $("#td_edit_delete_" + pk).html(button_save);
            $("#td_edit_delete_" + pk).append("&nbsp;&nbsp;");
            $("#td_edit_delete_" + pk).append(button_cancel);
            
            
            /* 点击取消按钮 还原回原来的数据 */
            
            button_cancel.click(function() {
                $("#td_nickname_" + pk).html(nickname);
                $("#td_mobile_" + pk).html(mobile);
                $("#td_address_" + pk).html(address);
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
                $("#td_sex_" + pk).html(sex); // 填充性别
                
                // 把保存和取消按钮换回编辑和删除
                $("#td_edit_delete_" + pk).html(a_edit + a_delete);
            });

            
            /* 点击保存按钮 向服务器提交修改后的数据 */
            button_save.click(function() {
                $.post(
                    '<?php echo DOMAIN . "index.php?p=admin&c=admin&a=edituserinfor"; ?>',
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
                        loadPage(current_page);
                });
            });
            
        });
        
    });
      
</script>