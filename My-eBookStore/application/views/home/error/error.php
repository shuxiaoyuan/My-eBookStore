<?php

/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../../../index.php");
    
    exit;
    
}

echo isset($errorMessage) ? $errorMessage : '';

exit;

