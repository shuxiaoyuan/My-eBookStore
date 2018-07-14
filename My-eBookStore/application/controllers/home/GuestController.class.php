<?php

/**

 * application/controllers/home/GuestController.class.php

 * 游客操作控制器

 * 本控制器的方法只允许游客身份操作

 */


/* 防止 URL 路径访问和已经登录的用户访问 */

if(!defined('ENTRY') || isset($_SESSION['user_name']) || isset($_SESSION['admin_name'])) {
    
    header("Location:../../../index.php");
    
    exit;
    
}

class GuestController extends Controller {
    
    public $userModel; // 用户模型
    
    public function __construct() {
        
        // 父类构造方法中有 $referer
        parent::__construct();
        
        // 创建用户模型
        $this -> userModel = new UserModel();
        
    }
    
    
    
    /* 访问登录页面方法 */
    
    public function loginViewAction() {
        
        // 记住登录之前的页面
        $this -> setSessionReferer();

        include  VIEW_HOME_PATH . "login/login.php";

    }
    
    
    /* 用户登录验证方法 */
    
    public function loginAction() {
        
        // 执行注册 接收返回状态信息
        $status = $this -> userModel -> userLogin();
        
        if($status === true) { // 登录成功

            // 返回登录前的页面
            $this -> redirect($this -> getSessionReferer());
            
        }
        else {

            // 弹窗提醒用户错误原因
            $this -> echoMessage($status);
            
            // 返回请求此方法的页面（一般是登录页面）
            $this -> redirect($this -> referer);
            
        }
        
    }
    
    
    
    /* 访问注册页面方法 */
    
    public function registerViewAction() {

        // 记住注册之前的页面
        $this -> setSessionReferer();
    
        include  VIEW_HOME_PATH . "register/register.php";
        
    } 
    
    
    /* 用户注册方法 */
    
    public function registerAction() {
        
        // 执行注册 接收返回状态信息
        $status = $this -> userModel -> userRegister();
        
        if($status === true) { // 注册成功
            
            // 弹窗提醒用户注册成功
            $this -> echoMessage("注册成功！");         
            
            // 返回注册前的页面
            $this -> redirect($this -> getSessionReferer());
            
        }
        else {

            // 弹窗提醒用户错误原因
            $this -> echoMessage($status);
            
            // 返回请求此方法的页面（一般是注册页面）
            $this -> redirect($this -> referer);
            
        }

    }
    
    
    /*  
     
     * 检查是否已经存在此用户名
     
     * 若存在则打印 true ，否则返回 false
     
     * 用于注册页面 Ajax 获取
     
     */
    
    public function hasUserAction() {

        $username = (isset($_POST['username']) && $_POST['username'] !== '') ? htmlspecialchars($_POST['username']) : $this -> errorPage("用户名不能为空！");
        
        if($this -> userModel -> hasInfor(FIELD_USER_NAME, $username)) {
            
            echo "true";
            
        }
        else {
            
            echo "false";
            
        }
        
    }
    
    
}