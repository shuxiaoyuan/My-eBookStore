<?php

/**
 
 * application/views/public/js.php
 
 * 网页底部 js 引入
 
 */


/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../../index.php");
    
    exit;
    
}

?>
<script src='<?php echo DOMAIN . "public/js/jquery-3.2.1.min.js"; ?>'></script>
  <script src='<?php echo DOMAIN . "public/js/bootstrap.min.js"; ?>'></script>
  <script src='<?php echo DOMAIN . "public/js/jquery.form.js"; ?>'></script>
  <script> 
    
    // 导航栏图书搜索
    $(document).ready(function() {
        
        // 图书搜索方法
        function bookSearch() {
            var book_name = $("#input_book_search").val();
            if(book_name) {
                var href = '<?php echo DOMAIN . "index.php?c=view&a=bookdetail&name="; ?>' + book_name;
                location.href = href;
            }
        }
        
        // 点击搜索
        $("#a_book_search").click(function() {
            bookSearch();
        });
        
        // 在搜索框回车
        $("#input_book_search").keydown(function(e) {
            var key = e.which;
            if(key == 13) { // 回车键是 13
                bookSearch();
                // 因为在 form 的输入框中回车会触发提交表单事件，这里 return false 会阻止提交表单行为
                return false; 
            }
        });
    
    });
    
  </script>

