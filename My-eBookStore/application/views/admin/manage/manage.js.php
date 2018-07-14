<?php

/* 防止 URL 路径访问和不是管理员的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['admin_name'])) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>
<script>
    
    $(document).ready(function() {
        
        /* 左边导航栏 */
        
        // 加载各个管理模块，并根据 id 切换 active class
        function loadManage(manage, id) {
            $(".left_nav").removeClass("active");
            $(id).addClass("active");
            //$("#content").load('<?php echo DOMAIN . "index.php?p=admin&c=view&a="; ?>' + manage);
            $("#content").load(
                '<?php echo DOMAIN . "index.php?p=admin&c=view&a=loadmanage"; ?>',
                {
                    type : manage
                }
            );
        }
        
        // 默认首先载入订单管理模块
        loadManage("order", "#li_order");
        
        // 由点击触发加载不同管理模块
        
        $("#order_manage").click(function() {
            loadManage("order", "#li_order");
        });        
        $("#sale_manage").click(function() {
            loadManage("sale", "#li_sale");
        });
        $("#book_manage").click(function() {
            loadManage("book", "#li_book");
        });
        $("#message_manage").click(function() {
            loadManage("message", "#li_message");
        });
        $("#user_manage").click(function() {
            loadManage("user", "#li_user");
        });
        $("#admin_manage").click(function() {
            loadManage("admin", "#li_admin");
        });
        
    });
    
  </script>
