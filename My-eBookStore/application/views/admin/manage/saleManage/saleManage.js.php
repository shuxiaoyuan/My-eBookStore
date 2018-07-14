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
            
            $("#sale_infor").load(
                '<?php echo DOMAIN . "index.php?p=admin&c=view&a=salemanage"; ?>',
                {
                    type : nav
                }
            );
        }
        
        // 设置默认导航标签
        var nav = "today_sale";
        
        // 默认加载第一个导航标签
        loadNav(nav);
  
  
    });
    
</script>