<?php

/**

 * application/controllers/admin/AdminController.class.php

 * 管理员操作控制器

 * 本控制器的方法只允许管理员身份操作

 */


/* 防止 URL 路径访问和没有权限的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['admin_name'])) {
    
    header("Location:../../../index.php");
    
    exit;
    
}


class AdminController extends Controller {
    
    
    /* 退出登录方法 */
    
    public function logoutAction() {
        
        /* 本模块代码来自 PHP 手册 */
        
        // 重置会话中的所有变量
        $_SESSION = array();

        // 如果要清理的更彻底，那么同时删除会话 cookie
        // 注意：这样不但销毁了会话中的数据，还同时销毁了会话本身
        if (ini_get("session.use_cookies")) {
            
            $params = session_get_cookie_params();
            
            setcookie(session_name(), '', time() - 42000,
            
                $params["path"], $params["domain"],
                
                $params["secure"], $params["httponly"]
                
            );
            
        }

        // 最后，销毁会话
        session_destroy();
  
        // 返回管理员登录页面
        $this -> redirect(DOMAIN . "index.php?p=admin&c=guest&a=loginview");
        
    }
    
    
    /** 
     
     * 根据用户主键删除用户的方法 
     
     * 因为此方法是用 jQuery Ajax post 调用，因此返回值是 echo
     
     */
    
    public function deleteUserAction() {
        
        // 接收主键参数
        if(isset($_POST['pk']) && $_POST['pk'] !== '') {
            
            $pk = htmlspecialchars($_POST['pk']);
            
            // 创建用户模型
            $userModel = new UserModel();
            
            // 执行删除用户操作并接收状态信息
            $status = $userModel -> deleteInfor($pk);
            
            if($status === false) {
                
                echo "删除用户失败！";
                
            }
            else {
                
                echo "true";
                
            }
            
        }
        else {
            
            echo "没有指定要删除的用户的主键！";
            
        }
        
    }
    
    
    /**
    
     * 根据用户主键编辑用户信息的方法 点击编辑之后的保存按钮会触发此方法

     * 因为此方法是用 jQuery Ajax post 调用，因此返回值是 echo

     */
    
    public function editUserInforAction() {
        
        // 创建用户模型
        $userModel = new UserModel();
        
        // 执行编辑
        $status = $userModel -> editUserInfor();
        
        if($status > 0) { // 编辑成功（影响的行数大于 0）

            echo "true";
        
        }
        else if($status === 0) { // 提交了和原来完全相同的信息
            
            echo "没有修改任何信息！";
            
        }
        else { // 编辑失败，显示原因
            
            echo $status;
            
        }
        
    }
    
    
    /* 上架图书方法 */
    
    public function addNewBookAction() {

        // 创建图书模型
        $bookModel = new BookModel();
        
        // 上架图书
        $status = $bookModel -> addNewBook();
          
        echo $status; // 返回信息
        
    }
    

    /**
    
     * 根据图书主键编辑图书售价的方法 点击编辑之后的保存按钮会触发此方法

     */
    
    public function editBookPriceAction() {
        
        // 创建图书模型
        $bookModel = new BookModel();
        
        // 执行编辑
        $status = $bookModel -> editBookPrice();
        
        if($status > 0) { // 编辑成功（影响的行数大于 0）

            echo "true";
        
        }
        else if($status === 0) { // 提交了和原来完全相同的信息
            
            echo "没有改变售价！";
            
        }
        else { // 编辑失败，显示原因
            
            echo $status;
            
        }
        
    }
    
    
    /** 
     
     * 根据图书主键下架图书的方法 
     
     * 因为此方法是用 jQuery Ajax post 调用，因此返回值是 echo
     
     */
    
    public function deleteBookAction() {
        
        // 接收主键参数
        if(isset($_POST['pk']) && $_POST['pk'] !== '') {
            
            $pk = htmlspecialchars($_POST['pk']);
            
            // 创建图书模型
            $bookModel = new BookModel();
            
            // 获取本图书的封面位置
            $bookCover = $bookModel -> getOneInfor(FIELD_BOOK_COVER, FIELD_BOOK_PK, $pk);
            
            // 执行下架图书操作并接收状态信息
            $status = $bookModel -> deleteInfor($pk);
            
            if($status === false) {
                
                echo "下架图书失败！";
                
            }
            else {
                
                // 别忘了删除网站目录下的图片
                if(unlink($bookCover)) {
                    
                    echo "true";
                    
                }
                else {
                    
                    echo "本书封面图片未能成功删除！";
                    
                }
                
            }
            
        }
        else {
            
            echo "没有指定要下架图书的主键！";
            
        }
        
    }
    
    
    /** 
     
     * 根据留言主键删除留言的方法 
     
     * 因为此方法是用 jQuery Ajax post 调用，因此返回值是 echo
     
     */
    
    public function deleteMessageAction() {
        
        // 接收主键参数
        if(isset($_POST['pk']) && $_POST['pk'] !== '') {
            
            $pk = htmlspecialchars($_POST['pk']);
            
            // 创建图书模型
            $messageModel = new MessageModel();
            
            // 执行下架图书操作并接收状态信息
            $status = $messageModel -> deleteInfor($pk);
            
            if($status === false) {
                
                echo "删除留言失败！";
                
            }
            else {
                
                echo "true";
                
            }
            
        }
        else {
            
            echo "没有指定要删除留言的主键！";
            
        }
        
    }
    
    
    /* 发货 */
    
    public function orderDeliveryAction() {
        
        $pk = (isset($_POST['pk']) && $_POST['pk'] !== '') ? htmlspecialchars($_POST['pk']) : die("没有指定要发货的订单！");
        
        $orderModel = new OrderModel();
        
        $state = 1; // 发货即将订单状态修改为 1
        
        $status = $orderModel -> editOrderState($pk, $state);
        
    }
    
    
}