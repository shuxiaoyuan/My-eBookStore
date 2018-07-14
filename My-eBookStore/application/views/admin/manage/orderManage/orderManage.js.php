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
        
        // 根据右边导航标签载入某个页面 并切换 active class
        function loadNav(nav) {
            $(".right_nav").removeClass("active");
            $("#li_" + nav).addClass("active");
            
            $("#order_infor").load(
                '<?php echo DOMAIN . "index.php?p=admin&c=view&a=ordermanage"; ?>',
                {
                    type : nav
                }
            );
        }
        
        // 设置默认导航标签
        var nav = "undelivered";
        
        // 默认加载第一个导航标签
        loadNav(nav);
        
        // 点击待发货导航标签
        $("#li_undelivered").click(function() {
            loadNav("undelivered");
        });
        
        // 点击已发货导航标签
        $("#li_delivered").click(function() {
            loadNav("delivered");
        });
        
        // 点击已完成导航标签
        $("#li_completed").click(function() {
            loadNav("completed");
        });
        
        /* 右边分页栏 */
        
        // 初始化当前页码为 1
        var current_page = 1;
        
        // 初始化尾页页码为 1 每次载入当前页面时会动态获取
        var last_page = 1;
        
        // active 类一直在当前页
        $("#li_current_page").addClass("active");
        
        // 载入当前页面
        //loadPage(current_page);
        
        // 根据页码载入某个页面 并切换 active class 和当前显示页码 并更新尾页页码
        function loadPage(page) {
            $("#current_page").text("第" + page + "页");
            $("#order_infor").load(
                '<?php echo DOMAIN . "index.php?p=admin&c=view&a=ordermanage"; ?>',
                {
                    type : "all_book",
                    page : page
                }
            );
            $.post(
                '<?php echo DOMAIN . "index.php?p=admin&c=view&a=getpagetotal"; ?>',
                {
                    type : "order",
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
        
        
        /* 对订单的操作 */
        
        // 展开或收起订单
        $("#order_infor").on("click", ".a_toggle", function() {
            var toggle_pk = this.getAttribute("id");
            var pk = toggle_pk.split("_")[1];
            $("#content_" + pk).slideToggle();
        });
        
        // 点击发货
        $("#order_infor").on("click", ".delivery_order", function() {
            if(!confirm("确认发货？")) return false;
            var delivery_pk = this.getAttribute("id");
            var pk = delivery_pk.split("_")[1];
            $.post(
                '<?php echo DOMAIN . "index.php?p=admin&c=admin&a=orderdelivery"; ?>',
                {
                    pk : pk
                },
                function() {
                    loadNav(nav);
            });
        });
        
    });
  
</script>