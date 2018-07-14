<?php

/**

 * framework/core/Framework.class.php

 * 核心框架类

 * 定义目录、自动加载类、请求处理和转发

 */


/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../index.php");
    
    exit;
    
}


class Framework {
    
    public static function run() {
        
        // 框架初始化
        self::init();
        
        // 自动加载 Controller 和 Model 类
        self::autoload();
        
        // 请求转发
        self::dispath();
    }
    

    private static function init() {
        
        /**

         * 请求分析定义模块

         * 貌似不用对其首字母进行大写处理 服务器会自动转换

         */

        /* 根据请求参数确定控制器和执行方法，这些参数用户可以构造 */
         
        define("PLATFORM", isset($_REQUEST['p']) ? $_REQUEST['p'] : 'home');
        define("CONTROLLER_PREFIX", isset($_REQUEST['c']) ? $_REQUEST['c'] : 'view');
        define("ACTION_PREFIX", isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index');
        
        /* 更具体的参数需要在具体方法里接收 */

        /* 根据当前请求的 platform （前端还是后台）确定控制器目录 */

        define("CURR_CONTROLLER_PATH", CONTROLLER_PATH . PLATFORM . DS);
        //define("CURR_VIEW_PATH", VIEW_PATH . PLATFORM . DS);


        /* 加载框架类 */
        
        require CORE_PATH . "Controller.class.php"; 
        require DB_PATH . "Mysql.class.php";
        require CORE_PATH . "Model.class.php";
              
        // 创建会话
        session_start();
        
    }
    
    // 自动加载 Controller 和 Model 类
    private static function autoload() {
        
        spl_autoload_register(array(__CLASS__, 'load'));
        
    }
    
    // 定义自动加载类方法中参数 load
    private static function load($classname) {

         if(substr($classname, -10) == "Controller") {
             
             // 防止用户构造请求访问一个不存在的控制器
             if(file_exists(CURR_CONTROLLER_PATH . "$classname.class.php")) {
                 
                 require_once CURR_CONTROLLER_PATH . "$classname.class.php";
                 
             }
             else {
                
                // 出现错误时的信息
                $errorMessage = "404 Not Found";
                
                include  VIEW_HOME_PATH . "error/error.php";
                 
             }
             
         }
         else if(substr($classname, -5) == "Model") {

             require_once MODEL_PATH . "$classname.class.php";
             
         }
    }
    
    // 路由和转发请求
    private static function dispath() {
        
        // 确定要请求的控制器类
        $controller_name = CONTROLLER_PREFIX . "Controller";
        
        // 确定要调用的控制器类中的方法
        $action_name = ACTION_PREFIX . "Action";
        
        
        /**
        
         * 创建对应的控制器类
        
         * 自动加载方法里已经进行了控制器类是否存在的判定
        
         */
        $controller = new $controller_name();
        
        
        /**
        
         * 调用对应的方法 
        
         * 防止用户构造请求访问一个不存在的方法
        
         */
        if(method_exists($controller, $action_name)) {
            
            $controller -> $action_name();
            
        }
        else {
            
            // 出现错误时的信息
            $errorMessage = "404 Not Found";
            
            include  VIEW_HOME_PATH . "error/error.php";
            
        }
        
    }
    
}
