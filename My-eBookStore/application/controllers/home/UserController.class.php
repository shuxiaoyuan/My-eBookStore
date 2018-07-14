<?php

/**

 * application/controllers/home/UserController.class.php

 * 用户操作控制器

 * 本控制器的方法只允许登录后的用户调用执行

 */


/* 防止 URL 路径访问以及跨权操作 */

if(!defined('ENTRY') || !isset($_SESSION['user_name'])) {
    
    header("Location:../../../index.php");
    
    exit;
    
}



class UserController extends Controller {
    

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
        
        
        /* 返回请求页面 */
        
        $this -> redirect($this -> referer);
        
    }
    
    
    /* 获取用户余额方法 */
    
    public function getBalanceAction() {

        $userName = $_SESSION['user_name'];
        
        $userModel = new UserModel();
        
        $userPK = $userModel -> getOneInfor(FIELD_USER_PK, FIELD_USER_NAME, $userName);
        
        $userBalance = $userModel -> getOneInfor(FIELD_USER_BALANCE, FIELD_USER_PK, $userPK);
        
        echo $userBalance;
        
    }
    
    
    /* 购买图书 */
    
    public function buyBookAction() {
        
        // 接收图书 pk 和 amount（可能为数组）默认 die 掉
        $pk = (isset($_POST['pk']) && $_POST['pk'] !== '') ? htmlspecialchars($_POST['pk']) : die("没有指定购买哪本书！");
        
        $amount = (isset($_POST['amount']) && $_POST['amount'] !== '') ? htmlspecialchars($_POST['amount']) : die("没有指定图书数量！");
        
        $bookModel = new BookModel();
        
        $userModel = new UserModel();
        
        $orderModel = new OrderModel();
        
        $userPK = $userModel -> getOneInfor(FIELD_USER_PK, FIELD_USER_NAME, $_SESSION['user_name']);
        
        $userID = $userModel -> getOneInfor(FIELD_USER_ID, FIELD_USER_PK, $userPK);
        
        $userName = $userModel -> getOneInfor(FIELD_USER_NAME, FIELD_USER_PK, $userPK);
        
        $userMobile = $userModel -> getOneInfor(FIELD_USER_MOBILE, FIELD_USER_PK, $userPK);
        
        $userAddress = $userModel -> getOneInfor(FIELD_USER_ADDRESS, FIELD_USER_PK, $userPK);
        
        // 用户余额
        $userBalance = $userModel -> getOneInfor(FIELD_USER_BALANCE, FIELD_USER_PK, $userPK);
        
        $bookID = $bookModel -> getOneInfor(FIELD_BOOK_ID, FIELD_BOOK_PK, $pk);
        
        $bookISBN = $bookModel -> getOneInfor(FIELD_BOOK_ISBN, FIELD_BOOK_PK, $pk);
        
        $bookName = $bookModel -> getOneInfor(FIELD_BOOK_NAME, FIELD_BOOK_PK, $pk);
        
        // 图书售价
        $bookPrice = $bookModel -> getOneInfor(FIELD_BOOK_PRICE, FIELD_BOOK_PK, $pk);
        
        // 图书总价
        $totalPrice = $bookPrice * $amount;
        
        if($userBalance < $totalPrice) die("余额不足！");
        
        $userBalance -= $totalPrice;
        
        // 订单号生成
        date_default_timezone_set('PRC'); // 时区设置为中国

        $orderNumber = date("YmdHis") . $userID;
        
        // 订单信息
        $orderInfor = array(
            
            FIELD_ORDER_ID => ($orderModel -> getAutoincrement()),
            
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
        $status = $orderModel -> insertInfor($orderInfor);
        
        if((!is_int($status))) {
            
            die("生成订单失败，请稍候重试！");
            
        }
        
        
        // 更新余额
        $userInfor = array(
            
            FIELD_USER_PK => $userPK,
            
            FIELD_USER_BALANCE => $userBalance
        
        );
        
        // 执行更新并返回结果
        $status = $userModel -> updateInfor($userInfor);
        
        if(is_int($status) && $status > 0) {
            
            echo "购买成功！";
            
        }
        else {
            
            echo "购买失败，请稍候重试！";
            
        }
        
    }
    
    /* 用户留言方法 */
    
    public function newMessageAction() {
        
        $messageModel = new MessageModel();
        
        $status = $messageModel -> newMessage();
        
        if($status === false) {
            
            $this -> echoMessage("留言失败！");
            
        }
        else if($status > 0) {
            
            $this -> echoMessage("留言成功");
            
        }
        else {
            
            $this -> echoMessage($status);
            
        }
        
        // 重定向到留言页面
        $this -> redirect(DOMAIN . "index.php?c=view&a=message");
    
    }
    
    
    /* 访问用户个人主页方法 */
    
    public function myIndexAction() {

        include VIEW_HOME_PATH . "user/user.php";
        
    }
    
     
    /* 用户个人主页要用 Ajax 加载的各个模块页面方法 */
     
    public function loadModuleAction() {
        
        // 接收请求参数
        $type = (isset($_REQUEST['type']) && $_REQUEST['type'] !== '') ? htmlspecialchars($_REQUEST['type']) : "order";
        
        $username = (isset($_REQUEST['username']) && $_REQUEST['username'] !== '') ? htmlspecialchars($_REQUEST['username']) : die("没有指定用户名！");
        
        $userModel = new UserModel();
        
        // 获取用户主键
        $userPK = $userModel -> getOneInfor(FIELD_USER_PK, FIELD_USER_NAME, $username);
        
        // 确定是哪一类请求
        switch($type) {
            
            case "order" : include  VIEW_HOME_PATH . "user/myOrder/myOrder.php"; break;
            
            case "shelf" : include  VIEW_HOME_PATH . "user/myShelf/myShelf.php"; break;
            
            case "message" : include  VIEW_HOME_PATH . "user/myMessage/myMessage.php"; break;
            
            case "account" : include  VIEW_HOME_PATH . "user/myAccount/myAccount.php"; break;
            
        }

    }
    
    
    
    /**
     
     * Ajax 动态获取某个模型实例页面数量
     
     * 点击尾页时触发
     
     * 前台页面的 ViewController 里也有相似的方法，但权限只限于图书留言
     
     * 用户控制器里的这个方法权限只限于自己的订单留言
     
     */
    public function getPageTotalAction() {
        
        // 接收请求参数 默认 die 掉
        $type = (isset($_POST['type']) && $_POST['type'] !== '') ? htmlspecialchars($_POST['type']) : die("没有指定哪种模型！");
        $each = (isset($_POST['each']) && $_POST['each'] !== '') ? htmlspecialchars($_POST['each']) : die("没有指定每页信息条数！");
        
        // 确定创建哪种模型
        switch($type) {
            
            case "order" : $viewModel = new ViewModel(new OrderModel()); break;
            
            case "message" : $viewModel = new ViewModel(new MessageModel()); break;
            
        }
        
        $userModel = new UserModel();
        
        $userID = $userModel -> getOneInfor(FIELD_USER_ID, FIELD_USER_NAME, $_SESSION['user_name']);
        
        // 获取分页数量 用于尾页的值
        $pageTotal = $viewModel -> getPageTotal($each, FIELD_MESSAGE_UID, $userID);
        
        echo $pageTotal;
        
    }
    
    
    /* 我的帐号模块 Ajax 加载 */
    
    public function myAccountAction() {
        
        $type = (isset($_REQUEST['type']) && $_REQUEST['type'] !== '') ? htmlspecialchars($_REQUEST['type']) : "profile";
        
        $username = (isset($_REQUEST['username']) && $_REQUEST['username'] !== '') ? htmlspecialchars($_REQUEST['username']) : die("没有指定用户名！");
        
        switch($type) {
            
            case "profile" : 
            
                $userModel = new UserModel();
                
                $userInfor = $userModel -> getOneInfor('', FIELD_USER_NAME, $username);
                
                include  VIEW_HOME_PATH . "user/myAccount/myProfile.php"; 
            
                break;
            
            case "setting" : include  VIEW_HOME_PATH . "user/myAccount/accountSetting.php"; break;
            
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
    
    
    /**
    
     * 根据用户主键修改用户密码方法 

     * 因为此方法是用 jQuery Ajax post 调用，因此返回值是 echo

     */
    
    public function editPasswordAction() {
        
        //echo "Hello";
        
        // 创建用户模型
        $userModel = new UserModel();
        
        // 执行修改密码
        $status = $userModel -> editPassword();
        
        if($status > 0) { // 修改密码成功（影响的行数大于 0）
            
            // 弹窗提示
            $this -> echoMessage("修改密码成功！");
            
            // 退出登录
            $this -> logoutAction();
            
            // 跳转到退出前页面已经包含在 logoutAction() 方法中
            //$this -> redirect(DOMAIN . "index.php?c=guest&a=loginview");
        
        }
        else if($status === 0) { // 提交了和原来完全相同的密码
            
            $this -> echoMessage("密码和原密码一致！");
            
            $this -> redirect($this -> referer);
            
        }
        else { // 修改密码失败，显示原因
            
            $this -> echoMessage($status);
            
            $this -> redirect($this -> referer);
            
        }

    }
    
    
    /* 我的留言模块 Ajax 加载 */
    
    public function myMessageAction() {
        
        $messageModel = new MessageModel();
        
        $userModel = new UserModel();
        
        $messageViewModel = new ViewModel($messageModel);
        
        $userID = $userModel -> getOneInfor(FIELD_USER_ID, FIELD_USER_NAME, $_SESSION['user_name']);
        
        $messageTotal = $messageModel -> getInforTotal(FIELD_MESSAGE_UID, $userID);
        
        $pageTotal = $messageViewModel -> getPageTotal(3, FIELD_MESSAGE_UID, $userID);
        
        $messages = $messageViewModel -> getPageInfor(3, FIELD_MESSAGE_UID, $userID);
        
        include  VIEW_HOME_PATH . "user/myMessage/allMessage.php";
        
    }
    
    
    /** 
     
     * 根据留言主键删除留言的方法 
     
     * 因为此方法是用 jQuery Ajax post 调用，因此返回值是 echo
     
     */
    
    public function deleteMessageAction() {
        
        // 接收主键参数
        if(isset($_POST['pk']) && $_POST['pk'] !== '') {
            
            $pk = htmlspecialchars($_POST['pk']);

            $messageModel = new MessageModel();
            
            $userModel = new UserModel();
            
            $userID = $messageModel -> getOneInfor(FIELD_MESSAGE_UID, FIELD_MESSAGE_ID, $pk);
            
            $userName = $userModel -> getOneInfor(FIELD_USER_NAME, FIELD_USER_ID, $userID);
            
            if($userName !== $_SESSION['user_name']) { // 判断要删除的留言是否属于当前登录用户
                
                echo "不能删除其他人的留言！";
                
                return;
            }
            
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
    
    
    /* 我的订单模块 Ajax 加载 */
    
    public function myOrderAction() {
        
        // 确定是哪种订单
        $type = (isset($_POST['type']) && $_POST['type'] !== '') ? htmlspecialchars($_POST['type']) : "undelivered";
        
        $orderModel = new OrderModel();
        
        $userModel = new UserModel();
        
        $orderViewModel = new ViewModel($orderModel);
        
        $userID = $userModel -> getOneInfor(FIELD_USER_ID, FIELD_USER_NAME, $_SESSION['user_name']);
        
        // 获取到所有我的订单记录
        $allMyOrders = $orderModel -> getSomeInfor('', '', '', FIELD_ORDER_UID, $userID);
        
        
        // 将订单号相同的合并为一个，根据订单状态放在不同数组
        
        $undeliveredOrders = array();
        
        $deliveredOrders = array();
        
        $completedOrders = array();
        
        foreach($allMyOrders as $single) {
            
            // $orderNum （订单号）作为 $myOrder 的第一维下标
            $orderNum = $single[FIELD_ORDER_NUMBER];
            
            // 此句妙绝
            switch($single[FIELD_ORDER_STATE]) {
                
                case 0 : $undeliveredOrders[$orderNum][] = $single; break;
                
                case 1 : $deliveredOrders[$orderNum][] = $single; break;
                
                case 2 : $completedOrders[$orderNum][] = $single; break;
                
            }
            
        }
        
        switch($type) {
            
            case "undelivered" : include  VIEW_HOME_PATH . "user/myOrder/undeliveredOrder.php"; break;
            
            case "delivered" : include  VIEW_HOME_PATH . "user/myOrder/deliveredOrder.php"; break;
            
            case "completed" : include  VIEW_HOME_PATH . "user/myOrder/completedOrder.php"; break;
            
        }
        
        
    }
    
    
    /** 
     
     * 根据订单主键取消订单的方法 
     
     * 因为此方法是用 jQuery Ajax post 调用，因此返回值是 echo
     
     */
    
    public function cancelOrderAction() {
        
        $OrderModel = new OrderModel();
        
        $status = $OrderModel -> deleteOrder();
        
        echo $status;
        
    }
    
    
    /**
    
     * 确认收货方法
     
     */
    public function confirmOrderAction() {
        
        $pk = (isset($_POST['pk']) && $_POST['pk'] !== '') ? htmlspecialchars($_POST['pk']) : die("没有指定要发货的订单！");
        
        $orderModel = new OrderModel();
        
        $state = 2; // 确认收货即将订单状态修改为 2
        
        $status = $orderModel -> editOrderState($pk, $state);
        
    }
    
    /* 我的书架模块 Ajax 加载 */
    
    public function myShelfAction() {
        
        $userModel = new UserModel();
        
        $shelfModel = new ShelfModel();
        
        // 图书信息必须实时从图书模型中获取
        $bookModel = new BookModel();
        
        $uid = $userModel -> getOneInfor(FIELD_USER_ID, FIELD_USER_NAME, $_SESSION['user_name']);
        
        // 根据当前用户 id 获取所有图书 id
        $shelf = $shelfModel -> getSomeInfor('*', '', '', FIELD_SHELF_UID, $uid);
        
        $books = array();
        
        foreach($shelf as $s) {
            
            $book = $bookModel -> getOneInfor('*', FIELD_BOOK_ID, $s[FIELD_SHELF_BID]);
            
            $book["shelf_id"] =  $s[FIELD_SHELF_ID];
            
            $books[] = $book;
            
        }
        
        include  VIEW_HOME_PATH . "user/myShelf/allBook.php";
        
    }
    
    
    /* 将图书加入书架 */
    
    public function addBookToShelfAction() {
        
        // 接收请求参数 默认 die 掉
        $bid = (isset($_POST['bid']) && $_POST['bid'] !== '') ? htmlspecialchars($_POST['bid']) : die("没有指定图书 id！");
        
        $shelfModel = new ShelfModel();
        
        $status = $shelfModel -> addBook($bid);
        
        echo $status;
        
    }
    
    
    /* 从书架移出图书（可能是多本） */
    
    public function removeBookFromShelfAction() {
        
        $shelfModel = new ShelfModel();
        
        $status = $shelfModel -> removeBook();
        
        echo $status;
        
    }
    

}