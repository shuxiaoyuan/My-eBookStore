<?php

/**

* application/models/UserModel.class.php

* 用户模型

*/


/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../index.php");
    
    exit;
    
}



class UserModel extends Model {
    
    /* 使用 framework/config/config.php 文件中的宏定义来初始化模型对应的表名 */
    
    public function __construct() {
        
        parent::__construct(TABLE_USER);
        
    }
    
    
    /**
     
     * 用户登录 
     
     * 若成功，则返回 true ；若失败，则返回失败原因信息
     
     */
    
    public function userLogin() {
        
        if(!(isset($_POST[LOGIN_USERNAME]) && $_POST[LOGIN_USERNAME] !== '')) return "用户名不能为空！";
        if(!(isset($_POST[LOGIN_PASSWORD]) && $_POST[LOGIN_PASSWORD] !== '')) return "密码不能为空！";

        $userInfor = array(
            
            FIELD_USER_NAME => htmlspecialchars($_POST[LOGIN_USERNAME]),
            
            FIELD_USER_PASSWORD => htmlspecialchars($_POST[LOGIN_PASSWORD])

        );
        
        
        /* 用户登录验证 此处需要考虑 PHP 值为空和 0 相等情况，所以用恒等号 */
        
        if($this -> getOneInfor(FIELD_USER_PASSWORD, FIELD_USER_NAME, $userInfor[FIELD_USER_NAME]) === $userInfor[FIELD_USER_PASSWORD]) {
            
            // 设置 session
            $_SESSION['user_name'] = $userInfor[FIELD_USER_NAME];
            
            // 返回登录成功
            return true;
            
        }
        else {
            
            return "用户名或密码错误！";
            
        }
        
    }
    
    
    /**
     
     * 新用户注册 
     
     * 若成功，则返回 true ；若失败，则返回失败原因信息
     
     */
    
    public function userRegister() {
        
        // 除了性别可以为空，其他都不能为空
        if(!(isset($_POST[REGISTER_USERNAME]) && $_POST[REGISTER_USERNAME] !== '')) return "用户名不能为空！";
        if(!(isset($_POST[REGISTER_PASSWORD]) && $_POST[REGISTER_PASSWORD] !== '')) return "密码不能为空！";
        if(!(isset($_POST[REGISTER_NICKNAME]) && $_POST[REGISTER_NICKNAME] !== '')) return "昵称不能为空";
        if(!(isset($_POST[REGISTER_MOBILE]) && $_POST[REGISTER_MOBILE] !== '')) return "手机号不能为空！";
        if(!(isset($_POST[REGISTER_ADDRESS]) && $_POST[REGISTER_ADDRESS] !== '')) return "地址不能为空！";
        
        // 此用户注册信息
        $userInfor = array(
            
            // 不给数据库提供插入 ID 会报 Errorcode: 1364
            FIELD_USER_ID => ($this -> getAutoincrement()),
            
            FIELD_USER_NAME => htmlspecialchars($_POST[REGISTER_USERNAME]),
            
            FIELD_USER_PASSWORD => htmlspecialchars($_POST[REGISTER_PASSWORD]),
            
            FIELD_USER_NICKNAME => htmlspecialchars($_POST[REGISTER_NICKNAME]),     

            FIELD_USER_SEX => (isset($_POST[REGISTER_SEX]) ? htmlspecialchars($_POST[REGISTER_SEX]) : ''),
            
            FIELD_USER_MOBILE => htmlspecialchars($_POST[REGISTER_MOBILE]),
            
            FIELD_USER_ADDRESS => htmlspecialchars($_POST[REGISTER_ADDRESS])
            
        );
        
        // 检查是否已经存在此用户名
        if(!($this -> hasInfor(FIELD_USER_NAME, $userInfor[FIELD_USER_NAME]))) {

            // 执行注册
            $status = $this -> insertInfor($userInfor);
            
            if($status !== false) {
                
                // 设置 session
                $_SESSION['user_name'] = $userInfor[FIELD_USER_NAME];
                
                // 返回 true
                return true;
                
            }
            else {
                
                return "用户注册失败！";
                
            }
            
        }
        else {
            
            return "用户名已经存在！";
            
        }

    }
    
    
    /**
     
     * 编辑用户信息 
     
     * 若成功，则返回 true ；若失败，则返回失败原因信息
     
     */
    
    public function editUserInfor() {
        
        // 接收要编辑的用户的参数 isset 函数防构造请求
        if(!(isset($_POST[EDIT_PK]) && $_POST[EDIT_PK] !== '')) return "没有指定要编辑的用户的主键，疑似伪造请求";
        if(!(isset($_POST[EDIT_NICKNAME]) && $_POST[EDIT_NICKNAME] !== '')) return "昵称为必填信息";
        if(!(isset($_POST[EDIT_MOBILE]) && $_POST[EDIT_MOBILE] !== '')) return "手机号为必填信息";
        if(!(isset($_POST[EDIT_ADDRESS]) && $_POST[EDIT_ADDRESS] !== '')) return "收货地址为必填信息";

        
        // 若未指定性别，默认为空
        
        // 信息更新列表
        $userInfor = array(
            
            FIELD_USER_PK => htmlspecialchars($_POST[EDIT_PK]),
            
            FIELD_USER_NICKNAME => htmlspecialchars($_POST[EDIT_NICKNAME]),
            
            FIELD_USER_MOBILE => htmlspecialchars($_POST[EDIT_MOBILE]),
            
            FIELD_USER_ADDRESS => htmlspecialchars($_POST[EDIT_ADDRESS]),
            
            FIELD_USER_SEX => (isset($_POST[EDIT_SEX]) ? htmlspecialchars($_POST[EDIT_SEX]) : '')
        
        );
        
        // 执行更新并返回结果
        return $this -> updateInfor($userInfor);
        
    }
    
    
    /**
     
     * 修改密码
     
     * 若成功，则返回 true ；若失败，则返回失败原因信息
     
     */
    
    public function editPassword() {
        
        // 接收要编辑的用户的旧密码和新密码
        if(!(isset($_POST[OLD_PASSWORD]) && $_POST[OLD_PASSWORD] !== '')) return "没有填写旧密码！";
        if(!(isset($_POST[NEW_PASSWORD]) && $_POST[NEW_PASSWORD] !== '')) return "没有填写新密码！";
        
        // 目前处于登录状态的用户名
        $username = $_SESSION['user_name'];
        
        // 根据用户名查询密码
        $password = $this -> getOneInfor(FIELD_USER_PASSWORD, FIELD_USER_NAME, $username);
        
        if($_POST[OLD_PASSWORD] !== $password) return "原密码输入不正确！";
        
        // 根据用户名获取用户主键
        $userPK = $this -> getOneInfor(FIELD_USER_PK, FIELD_USER_NAME, $username);
        
        // 信息更新列表
        $userInfor = array(
            
            FIELD_USER_PK => $userPK,
            
            FIELD_USER_PASSWORD => htmlspecialchars($_POST[NEW_PASSWORD])
        
        );
        
        // 执行更新并返回结果
        return $this -> updateInfor($userInfor);
    }
    

}