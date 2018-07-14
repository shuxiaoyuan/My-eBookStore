<?php

/**

* application/models/OrderModel.class.php

* 订单模型

*/

/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../index.php");
    
    exit;
    
}

class OrderModel extends Model {
    
    public function __construct() {
        
        parent::__construct(TABLE_ORDER);
        
    }
    
    
    /* 提交生成一条订单记录 */
    
    public function submitOrder() {
        
        // 订单信息
        $orderInfor = array(
            
            FIELD_ORDER_ID => ($this -> getAutoincrement()),
            
            FIELD_ORDER_UID => $userID,
            
            FIELD_ORDER_UNAME => $userName,
            
            FIELD_ORDER_UMOBILE => $userMobile,
            
            FIELD_ORDER_UADDRESS => $userAddress,
            
            FIELD_ORDER_BID => $bookID,
            
            FIELD_ORDER_BISBN => $bookISBN,
            
            FIELD_ORDER_BNAME => $bookName,
            
            FIELD_ORDER_BPRICE => $bookPrice,
            
            FIELD_ORDER_BAMOUNT => $amount,
            
            FIELD_ORDER_NUMBER => $orderNumber
            
        );
        
        // 生成订单
        $status = $this -> insertInfor($orderInfor);
        
        if((!is_int($status))) {
            
            die("生成订单记录失败，请稍候重试！");
            
        }
        
        return $status;
        
    }
    
    
    /* 删除订单记录方法 */
    
    public function deleteOrder() {
        
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
            
            return "成功删除订单！";
            
        }
        else {
            
            return "删除订单失败，请稍后重试！";
            
        }
        
    }
    
    
    /* 修改订单状态方法 */
    
    public function editOrderState($pk, $state) {
        
        $orderInfor = array(
        
            FIELD_ORDER_PK => htmlspecialchars($pk),
            
            FIELD_ORDER_STATE => htmlspecialchars($state)
        
        );
        
        $status = $this -> updateInfor($orderInfor);
        
        if(is_int($status) && $status > 0) {
            
            return true;
            
        }
        else {
            
            return false;
            
        }
        
    }
    
    
    
}