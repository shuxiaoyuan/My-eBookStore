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
        
        // 默认为“所有留言”导航标签添加 active 类
        $("#li_all_message").addClass("active");
        
        
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
            $("#message_infor").load(
                '<?php echo DOMAIN . "index.php?p=admin&c=view&a=messagemanage"; ?>',
                {
                    page : page
                }
            );
            $.post(
                '<?php echo DOMAIN . "index.php?p=admin&c=view&a=getpagetotal"; ?>',
                {
                    type : "message",
                    each : 3
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
        
        
        /* 对留言的具体操作 */
        
        // 展开或收起留言
        $("#message_infor").on("click", ".title", function() {
            var title_pk = this.getAttribute("id");
            var pk = title_pk.split("_")[1];
            $("#content_" + pk).slideToggle();
            
        });
        
        // 删除留言
        $("#message_infor").on("click", ".message_delete", function() {
            var delete_pk = this.getAttribute("id");
            var pk = delete_pk.split("_")[1];
            if(confirm("确实要删除此条留言吗？")) {
                $.post(
                    '<?php echo DOMAIN . "index.php?p=admin&c=admin&a=deletemessage"; ?>',
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
        
        
    });

</script>