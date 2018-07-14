<?php

/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../../../index.php");
    
    exit;
    
}

?>
<script>

    $(document).ready(function() {
        $("#button_message_submit").click(function() {
            // 首先要判断是否处于用户登录状态
            var state = "<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ""; ?>";
            if(state === "") {
                alert("请先登录！");
                return false; // 阻止默认表单提交行为
            }
        });
        
    });

</script>
