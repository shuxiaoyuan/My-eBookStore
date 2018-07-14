<?php

/**

 * application/controllers/admin/ViewController.class.php

 * 管理员视图控制器

 * 注意！此页面中的方法允许所有用户和游客通过构造请求执行

 */


/* 防止 URL 路径访问和非管理员访问 */

if(!defined('ENTRY') || !isset($_SESSION['admin_name'])) {
    
    header("Location:../../../index.php");
    
    exit;
    
}

class ViewController extends Controller {
    
    
    /* 访问后台管理主页方法 */
    
    public function manageAction() {
        
        // 加载后台主页页面

        include  VIEW_ADMIN_PATH . "manage/manage.php";

    }

    
    /* 管理员管理页面要用 Ajax 加载的各个模块页面方法 */
     
    public function loadManageAction() {
        
        // 接收请求参数
        $type = (isset($_REQUEST['type']) && $_REQUEST['type'] !== '') ? htmlspecialchars($_REQUEST['type']) : "order";
        
        // 确定是哪一类请求
        switch($type) {
            
            case "order" : include  VIEW_ADMIN_PATH . "manage/orderManage/orderManage.php"; break;
            
            case "sale" : include  VIEW_ADMIN_PATH . "manage/saleManage/saleManage.php"; break;
            
            case "book" : include  VIEW_ADMIN_PATH . "manage/bookManage/bookManage.php"; break;
            
            case "message" : include  VIEW_ADMIN_PATH . "manage/messageManage/messageManage.php"; break;
            
            case "user" : include  VIEW_ADMIN_PATH . "manage/userManage/userManage.php"; break;
            
            case "admin" : include  VIEW_ADMIN_PATH . "manage/adminManage/adminManage.php"; break;
            
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
            
            case "book" : $viewModel = new ViewModel(new BookModel()); break;
            
            case "message" : $viewModel = new ViewModel(new MessageModel()); break;
            
            case "user" : $viewModel = new ViewModel(new UserModel()); break;
            
            case "admin" : $viewModel = new ViewModel(new AdminModel()); break;
            
        }
        
        // 获取分页数量 用于尾页的值
        $pageTotal = $viewModel -> getPageTotal($each);
        
        echo $pageTotal;
        
    }
    
    
    /* 用于 userManage.php 分页动态加载用户信息 包括分页加载和搜索用户 */

    public function userManageAction() {
        
        // 接收请求参数 默认为 page
        $type = (isset($_POST['type']) && $_POST['type'] !== '') ? htmlspecialchars($_POST['type']) : "page";
        
        // 创建用户模型
        $userModel = new UserModel();
        
        // 获取用户数量
        $inforTotal = $userModel -> getInforTotal();
        
        // 创建用户视图模型
        $userViewModel = new ViewModel($userModel);
        
        // 获取对用户分页数量
        $pageTotal = $userViewModel -> getPageTotal(6);
        
        // 确定是哪一类请求
        switch($type) {
            
            // 分页获取用户信息，每页 6 条
            case "page" : $userInfor = $userViewModel -> getPageInfor(6); break;
            
            case "search" : $userInfor[0] = $userViewModel -> getSearchInfor(FIELD_USER_NAME); break;
            
            default : $type = "page";
            
        }

        include  VIEW_ADMIN_PATH . "manage/userManage/userInfor.php";
        
    }

    
    /* 用于 bookManage.php 分页动态加载图书信息 以及新书上架 */

    public function bookManageAction() {
        
        // 接收请求参数 默认为 all_book
        $type = (isset($_POST['type']) && $_POST['type'] !== '') ? htmlspecialchars($_POST['type']) : "all_book";
        
        // 确定是哪一类请求
        switch($type) {
            
            case "all_book" : 
                
                // 创建图书模型
                $bookModel = new BookModel();
                
                // 获取图书数量
                $bookTotal = $bookModel -> getInforTotal();
                
                // 创建图书视图模型
                $bookViewModel = new ViewModel($bookModel);
                
                // 获取对图书分页数量
                $pageTotal = $bookViewModel -> getPageTotal(4);
                
                // 检测图书搜索请求
                $bookName = (isset($_POST['name']) && $_POST['name'] !== '') ? htmlspecialchars($_POST['name']) : "";
                
                $books = array();
                
                if($bookName !== "") { // 图书搜索请求
                    
                    $bookID = $bookModel -> getOneInfor(FIELD_BOOK_ID, FIELD_BOOK_NAME, $bookName);
                    
                    if($bookID) {
                    
                        $books[0] = $bookModel -> getOneInfor('', FIELD_BOOK_ID, $bookID);
                    
                    }
                    else {
                        
                        die("没有找到这本书。");
                        
                    }
                    
                }
                else { // 分页显示图书，分页请求处理写在了 ViewModel 里
                    
                    // 获取一页 4 本图书信息
                    $books = $bookViewModel -> getPageInfor(4);
                    
                }
            
                include  VIEW_ADMIN_PATH . "manage/bookManage/allBook.php"; 
                
                break;
            
            case "new_book" : include  VIEW_ADMIN_PATH . "manage/bookManage/newBook.php"; break;
            
        }
        
    }
    
    
    /* 用于 messageManage.php 分页动态加载留言 */

    public function messageManageAction() {
        
        $messageModel = new MessageModel();

        $messageTotal = $messageModel -> getInforTotal();
        
        $messageViewModel = new ViewModel($messageModel);
        
        $pageTotal = $messageViewModel -> getPageTotal(3);
        
        $messages = $messageViewModel -> getPageInfor(3);
        
        // 创建用户模型
        $userModel = new UserModel();
        
        $len = count($messages);
        
        for($i = 0; $i < $len; $i++) {
            
            $messages[$i][FIELD_USER_NAME] = $userModel -> getOneInfor(FIELD_USER_NAME, FIELD_USER_ID, $messages[$i][FIELD_MESSAGE_UID]);
            
        }
        
        include  VIEW_ADMIN_PATH . "manage/messageManage/allMessage.php";
        
    }
    
    
    /* 销售管理 */
    
    public function saleManageAction() {
        
        // 接收请求参数 默认为 all_book
        $type = (isset($_POST['type']) && $_POST['type'] !== '') ? htmlspecialchars($_POST['type']) : "today_sale";
        
        // 确定是哪一类请求
        switch($type) {
            
            case "today_sale" : 
            
                include  VIEW_ADMIN_PATH . "manage/saleManage/todaySale.php"; 
                
                break;
            
            case "month_sale" : include  VIEW_ADMIN_PATH . "manage/saleManage/monthSale.php"; break;
            
            case "total_sale" : include  VIEW_ADMIN_PATH . "manage/saleManage/totalSale.php"; break;
            
        }
    
    }
    
    
    /* 订单管理 */
    
    public function orderManageAction() {
        
        // 接收请求参数 默认为 all_book
        $type = (isset($_POST['type']) && $_POST['type'] !== '') ? htmlspecialchars($_POST['type']) : "undelivered";
        
        $orderModel = new OrderModel();
        
        $orderViewModel = new ViewModel($orderModel);
        
        // 获取到所有我的订单记录
        $allMyOrders = $orderModel -> getSomeInfor('', '', '');
        
        
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
        
        // 确定是哪一类请求
        switch($type) {
            
            case "undelivered" : include  VIEW_ADMIN_PATH . "manage/orderManage/undeliveredOrder.php"; break;
            
            case "delivered" : include  VIEW_ADMIN_PATH . "manage/orderManage/deliveredOrder.php"; break;
            
            case "completed" : include  VIEW_ADMIN_PATH . "manage/orderManage/completedOrder.php"; break;
            
        }
        
    }
    
    
    /* 管理员个人信息管理 */
    
    public function adminManageAction() {
        
        // 接收请求参数 默认为 all_book
        $type = (isset($_POST['type']) && $_POST['type'] !== '') ? htmlspecialchars($_POST['type']) : "edit_password";
        
        // 确定是哪一类请求
        switch($type) {
            
            case "edit_password" : 
            
                include  VIEW_ADMIN_PATH . "manage/adminManage/editPassword.php"; 
                
                break;
            
        }
        
    }

}