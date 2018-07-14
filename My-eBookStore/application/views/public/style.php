<?php

/**
 
 * application/views/public/footer.php
 
 * 网页头部样式
 
 */


/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../../index.php");
    
    exit;
    
}

?>
<meta charset="UTF-8">
  <meta name="viewport" content="device-width, initial-scale=1.0">
  <link href='<?php echo DOMAIN . "public/images/tab/16.png"; ?>' rel="shortcut icon">
  <link href='<?php echo DOMAIN . "public/css/bootstrap.min.css";?>' rel="stylesheet">
  <link href='<?php echo DOMAIN . "public/css/bootstrap-theme.min.css";?>' rel="stylesheet">
  <!--[if lt IE 9]>
    <script src='<?php echo DOMAIN . "public/js/html5shiv.min.js"; ?>'></script>
    <script src='<?php echo DOMAIN . "public/js/respond.min.js"; ?>'></script>
  <![endif]-->
  <style>
    body,html {
      height:100%;
    }
    #main {
      min-height:100%;
      position: relative;
      padding-top:70px;
    }
  </style>
