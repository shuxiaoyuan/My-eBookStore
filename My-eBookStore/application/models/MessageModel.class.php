<?php

/**

* application/models/MessageModel.class.php

* 留言模型

*/


/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../index.php");
    
    exit;
    
}

class MessageModel extends Model {
    
    public function __construct() {
        
        parent::__construct(TABLE_MESSAGE);
        
    }
    
    
    /**
     
     * 添加新的留言
     
     */
    
    public function newMessage() {
        
        if(!(isset($_POST[MESSAGE_TITLE]) && $_POST[MESSAGE_TITLE] !== '')) return "留言标题不能为空！";
        if(!(isset($_POST[MESSAGE_CONTENT]) && $_POST[MESSAGE_CONTENT] !== '')) return "留言内容不能为空！";
        
        $userModel = new UserModel();
        
        $messageInfor = array(
        
            FIELD_MESSAGE_ID => ($this -> getAutoincrement()),
            
            FIELD_MESSAGE_UID => ($userModel -> getOneInfor(FIELD_USER_ID, FIELD_USER_NAME, $_SESSION['user_name'])),
            
            FIELD_MESSAGE_TITLE => htmlspecialchars($_POST[MESSAGE_TITLE]),
            
            FIELD_MESSAGE_CONTENT => htmlspecialchars($_POST[MESSAGE_CONTENT])
        
        );
        
        // 执行添加新留言
        $status = $this -> insertInfor($messageInfor);
        
        return $status;
        
    }
    
}