<?php

/**

 * application/controllers/home/ViewController.class.php

 * 视图控制器

 * 注意！此页面中的方法允许所有用户和游客通过构造请求执行

 */


/** 

 * 防止 URL 路径访问

 * 所有身份都可以访问本页面方法 
 
*/

if(!defined('ENTRY')) {
    
    header("Location:../../../index.php");
    
    exit;
    
}

class ViewController extends Controller {
    
    
    /* 访问主页方法 */
    
    public function indexAction() {
       
        // 加载视图页面

        include  VIEW_HOME_PATH . "index/index.php";

    }
    
    
    /* 访问书店详情页方法 */
    
    public function aboutBookStoreAction() {

        include  VIEW_HOME_PATH . "about/aboutBookStore.php";

    }
    
    
    /**
     
     * Ajax 动态获取图书模型实例页面数量
     
     * 点击尾页时触发
     
     */
    public function getBookTotalAction() {
        
        // 接收请求参数 默认 die 掉
        $type = (isset($_POST['type']) && $_POST['type'] !== '') ? htmlspecialchars($_POST['type']) : die("没有指定哪种模型！");
        $each = (isset($_POST['each']) && $_POST['each'] !== '') ? htmlspecialchars($_POST['each']) : die("没有指定每页信息条数！");
        
        if($type !== "IT" && $type !== "English" && $type !== "else") die("图书类型不正确！");
        
        $viewModel = new ViewModel(new BookModel());
    
        // 获取分页数量 用于尾页的值
        $pageTotal = $viewModel -> getPageTotal($each, FIELD_BOOK_TYPE, $type);
        
        echo $pageTotal;
        
    }
    
    /* 书籍分类下拉菜单下的页面 */
     
    public function bookTypeAction() {
        
        // 确定请求类型
        $type = (isset($_REQUEST['type']) && $_REQUEST['type'] !== '') ? htmlspecialchars($_REQUEST['type']) : "IT";
        
        // 确定是哪一类书籍
        switch($type) {
            
            case "IT" : $type = "IT"; break;
            
            case "English" : $type = "English"; break;
            
            case "else" : $type = "else"; break;
            
            default : $type = "IT";
            
        }

        include  VIEW_HOME_PATH . "book/type/bookType.php";

    }
    
    
    /* 图书分类分页 Ajax 请求 */
    public function bookTypePageAction() {
        
        // 确定分页请求的图书类型
        $type = (isset($_REQUEST['type']) && $_REQUEST['type'] !== '') ? htmlspecialchars($_REQUEST['type']) : die("没有指定哪种类型的图书！");;
        
        // 创建图书模型
        $bookModel = new BookModel();
        
        // 获取此类图书数量
        $bookTotal = $bookModel -> getInforTotal(FIELD_BOOK_TYPE, $type);
        
        // 创建图书视图模型
        $bookViewModel = new ViewModel($bookModel);
        
        // 获取对此类图书分页数量
        $pageTotal = $bookViewModel -> getPageTotal(4, FIELD_BOOK_TYPE, $type);
        
        // 获取一页 12 本此类图书信息
        $books = $bookViewModel -> getPageInfor(4, FIELD_BOOK_TYPE, $type);
        
        include  VIEW_HOME_PATH . "book/type/bookTypePage.php";
        
    }

    
    /* 访问书籍详情页的方法 */
    public function bookDetailAction() {
        
        // 请求的图书书名
        $bookName = (isset($_REQUEST['name']) && $_REQUEST['name'] !== '') ? htmlspecialchars($_REQUEST['name']) : "";
        
        // 请求的图书 id 
        $bookID = (isset($_REQUEST['id']) && $_REQUEST['id'] !== '') ? htmlspecialchars($_REQUEST['id']) : "";
        
        $bookModel = new BookModel();
        
        if($bookName !== "") {
            
            $bookID = $bookModel -> getOneInfor(FIELD_BOOK_ID, FIELD_BOOK_NAME, $bookName);
            
        }
        
        if($bookID === "") {
            
            $this -> errorPage("非法请求！");
            
        }

        $book = $bookModel -> getOneInfor('', FIELD_BOOK_ID, $bookID);
        
        if(!$book) { // 防止用户构造 id 参数
            
            $this -> errorPage("没找到这本书！");
            
        }
        
        include  VIEW_HOME_PATH . "book/detail/bookDetail.php";
        
    }
    
    
    /* 访问留言反馈页面方法 */
    
    public function messageAction() {
        
        $messageModel = new MessageModel();
        
        // 获取一条最新留言信息
        $messages = $messageModel -> getSomeInfor('*', 0, 1);
        
        $message = $messages[0];
        
        $userModel = new UserModel();
        
        // 获取留言人昵称
        $userName = $userModel -> getOneInfor(FIELD_USER_NICKNAME, FIELD_USER_ID, $message[FIELD_MESSAGE_UID]);
        
        include  VIEW_HOME_PATH . "message/message.php";

    }
    
    
    /* 访问关于我们页面方法 */
    
    public function aboutUSAction() {

        include  VIEW_HOME_PATH . "about/aboutUs.php";

    }
    
}