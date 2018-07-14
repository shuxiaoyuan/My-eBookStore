<?php

/**

* application/models/ShelfModel.class.php

* 书架模型

*/


/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../index.php");
    
    exit;
    
}

class ShelfModel extends Model {
    
    public function __construct() {
        
        parent::__construct(TABLE_SHELF);
        
    }
    
    
    /* 向书架上添加图书 */
    
    public function addBook($bid) {
        
        $userModel = new UserModel();
        
        $uid = $userModel -> getOneInfor(FIELD_USER_ID, FIELD_USER_NAME, $_SESSION['user_name']);
        
        $shelfInfor = array(
        
            FIELD_SHELF_ID => ($this -> getAutoincrement()),
            
            FIELD_SHELF_UID => $uid,
            
            FIELD_SHELF_BID => $bid
        
        );
        
        $status = $this -> insertInfor($shelfInfor);
        
        // 成功插入的话返回插入 id 
        if(is_int($status)) {
            
            return "成功加入书架！";
            
        }
        else {
            
            return "加入书架失败，请稍后重试！";
            
        }
        
    }
    
    
    /* 从书架上移出图书，支持传参为数组从而移出多本 */
    
    public function removeBook() {
        
        $pk = -1;
        
        // 传参为数组
        if(is_array($_POST['pk'])) {
            
            $pk = array();
            
            $t = $_POST['pk'];
            
            foreach($t as $id) {
                
                $pk[] = htmlspecialchars($id);
                
            }
            
        }
        else {
            
            $pk = htmlspecialchars($_POST['pk']);
            
        }
        
        $status = $this -> deleteInfor($pk);
        
        // 影响行数大于 0
        if(is_int($status) && $status > 0) {
            
            return "成功移出书架！";
            
        }
        else {
            
            return "移出书架失败，请稍后重试！";
            
        }
        
    }
    
    
}