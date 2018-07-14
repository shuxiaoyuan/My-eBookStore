<?php

/**
 
 * 控制器基类

 * 比原始代码删去了自动加载 libraries 和 helpers 中的类的 Loader

 */


/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../index.php");
    
    exit;
    
}


class Controller {
    
    public $referer;
    
    
    /**
    
     * 记住每次调用控制器方法的 referer 并作为每个控制器的属性存储
    
     * 默认 referer 为主页
    
     */  
    
    public function __construct() {
         
        $this -> referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : DOMAIN . "index.php";
        
    }
    
    
    /**
    
     * 设置 $_SESSION[referer] ，便于返回某个页面的请求页面
    
     * 但注意，这个方法不是类属性 referer 的 set 方法
     
     * 并且必须保证请求来源是 ViewController 下的方法
    
     */
    
    protected function setSessionReferer() {
        
        $_SESSION['referer'] = (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], "c=view") !== false) ? $_SERVER['HTTP_REFERER'] : DOMAIN . "index.php";
        
    }
    
    
    /**
    
     * 返回 $_SESSION['referer'] ，没有设置则返回为主页
    
     */
    
    protected function getSessionReferer() {
        
        return isset($_SESSION['referer']) ? $_SESSION['referer'] : DOMAIN . "index.php";
        
    }
    
    
    /* 以 JS 弹窗方式提醒用户信息 */
    
    protected function echoMessage($message) {
        
        echo "<script>alert('" . $message . "');</script>";
    
    }
    
    
    /**
    
     * 重定向到某个页面并退出当前执行的方法
    
     * 默认重定向到主页
    
     * 重定向到错误页面时，$message 为传递的错误信息 
    
     */
    
    protected function redirect($url = DOMAIN . "index.php", $message = '错误！') {
                 
        // 用 JS 脚本重定向网页可以保证之前的弹窗得到执行
        echo "<script>location.href='" . $url . "';</script>";
        
        exit;
        
    }
    
    /**
    
     * 错误信息显示页面
     
     * 一般是网站测试过程中或渗透测试中会触发此方法
     
     */
     protected function errorPage($errorMessage) {
         
         include  VIEW_HOME_PATH . "error/error.php";
         
     }
    
}

