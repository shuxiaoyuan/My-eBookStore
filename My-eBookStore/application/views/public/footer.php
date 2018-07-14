<?php

/**
 
 * application/views/public/footer.php
 
 * 网页底部版权信息
 
 */


/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../../index.php");
    
    exit;
    
}


?>
<div id="before_footer" class="row" style="padding-top: 10px; padding-bottom: 60px;">
    </div>
    <div id="footer" class="row" style="position:absolute; bottom:0; padding:10px 0; width:100%;">
      <p class="text-center text-muted">Copyright &copy; 2017 <a href='<?php echo DOMAIN . "index.php?c=view&a=aboutus"; ?>' title="My-eBookStoreTeam" target="_top">My-eBookStoreTeam</a> All Rights Reserved.</p>
    </div>
