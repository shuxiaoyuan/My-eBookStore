<?php

/**

 * application/controllers/admin/GuestController.class.php

 * 游客操作控制器

 * 本控制器的方法只允许游客身份操作

 */


/* 防止 URL 路径访问和已经登录的管理员访问 */

if(!defined('ENTRY') || isset($_SESSION['user_name']) || isset($_SESSION['admin_name'])) {
    
    header("Location:../../../index.php");
    
    exit;
    
}

class GuestController extends Controller {
    
    public $adminrModel; // 管理员模型
    
    public function __construct() {
        
        // 父类构造方法中有 $referer
        parent::__construct();
        
        // 创建管理员模型
        //$this -> adminModel = new AdminModel();
        $this -> adminModel = new Model(TABLE_ADMIN);
        
    }
    
    
    /**
     
     * 访问后台登录页面方法
     
     * 这个只有游客身份才能访问，因此没有放在 ViewController 的方法中
     
     */
    
    public function loginViewAction() {
        
        // 记住登录之前的页面
        $this -> setSessionReferer();

        include  VIEW_ADMIN_PATH . "login/login.php";

    }
    
    /* 管理员登录验证方法 */
    
    public function loginAction() {
        
        //die("#" . $this -> referer . "#");
        
        // 定义出错时要弹出的窗口信息
        $emptyMessage = " 用户名和密码均不能为空！";
        
        $errorMessage = "用户名或密码错误！";
        
        
        /**
        
         * 用数组存储管理员表单提交的登录信息 
        
         * 出错时返回 $this -> referer
        
         * 输入为空和 isset 有区别 三目运算符保证了 isset 和输入为空都使数组变量为空 
        
         */
        $adminInfor = array(
            
            FIELD_ADMIN_NAME => ((isset($_POST[LOGIN_ADMINNAME]) && $_POST[LOGIN_ADMINNAME] !== '') ? htmlspecialchars($_POST[LOGIN_ADMINNAME]) : ($this -> echoMessage($emptyMessage) . $this -> redirect($this -> referer))),
            
            FIELD_ADMIN_PASSWORD => ((isset($_POST[LOGIN_ADMINPASS]) && $_POST[LOGIN_ADMINPASS] !== '') ? htmlspecialchars($_POST[LOGIN_ADMINPASS]) : ($this -> echoMessage($emptyMessage) . $this -> redirect($this -> referer)))
            
            
        );
        
        
        /* 管理员登录验证 此处需要考虑 PHP 值为空和 0 相等情况，所以用恒等号 */
        
        //if($this -> adminModel -> getAdminInfor(FIELD_ADMIN_PASSWORD, $adminInfor[FIELD_ADMIN_NAME]) === $adminInfor[FIELD_ADMIN_PASSWORD]) {
        if($this -> adminModel -> getOneInfor(FIELD_ADMIN_PASSWORD, FIELD_ADMIN_NAME, $adminInfor[FIELD_ADMIN_NAME]) === $adminInfor[FIELD_ADMIN_PASSWORD]) {
            
            // 设置 $_SESSION['admin_name']
            $_SESSION['admin_name'] = $adminInfor[FIELD_ADMIN_NAME];
            
            // 重定向到管理员主页
            $this -> redirect($this -> redirect(DOMAIN . "index.php?p=admin&c=view&a=manage"));
            
        }
        else {
            
            // 管理员账户名或密码错误
            
            $this -> echoMessage($errorMessage);
            
            $this -> redirect($this -> referer);
            
        }
        
    }
        
}