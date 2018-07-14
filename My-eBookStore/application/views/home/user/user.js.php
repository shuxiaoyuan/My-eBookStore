<?php

/* 防止 URL 路径访问和没有登录的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['user_name']) ) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>
<script>
    $(document).ready(function() {
        
        /* 左边导航栏 */
        
        // 加载各个功能模块，并根据 id 切换 active class
        function loadModule(module, id) {
            $(".left_nav").removeClass("active");
            $(id).addClass("active");
            $("#content").load(
                '<?php echo DOMAIN . "index.php?c=user&a=loadmodule"; ?>',
                {
                    type : module,
                    username : "<?php echo $_SESSION['user_name'];?>"
                }
            );
        }
        
        // 默认首先载入我的订单模块
        loadModule("order", "#li_order");
        
        // 由点击触发加载不同模块
        
        $("#my_order").click(function() {
            loadModule("order", "#li_order");
        });
        $("#my_shelf").click(function() {
            loadModule("shelf", "#li_shelf");
        });
        $("#my_message").click(function() {
            loadModule("message", "#li_message");
        });
        $("#my_account").click(function() {
            loadModule("account", "#li_account");
        });
        
    });
  </script>
