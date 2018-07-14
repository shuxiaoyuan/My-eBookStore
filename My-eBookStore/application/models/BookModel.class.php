<?php

/**

* application/models/BookModel.class.php

* 图书模型

*/


/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../index.php");
    
    exit;
    
}

class BookModel extends Model {
    
    public function __construct() {
        
        parent::__construct(TABLE_BOOK);
        
    }
    
    
    /**
     
     * 图书添加
     
     */
    public function addNewBook() {
         
        // 检查表单信息是否齐全
        if(!(isset($_POST[NEWBOOK_ISBN]) && $_POST[NEWBOOK_ISBN] !== '')) return "ISBN不能为空！";
        if(!(isset($_POST[NEWBOOK_AMOUNT]) && $_POST[NEWBOOK_AMOUNT] !== '')) return "上架数量不能为空！";
         
        // 如果 isbn 已经存在，只更新图书数量信息
        if($this -> hasInfor(FIELD_BOOK_ISBN, htmlspecialchars($_POST[NEWBOOK_ISBN]))) {
             
            $book[FIELD_BOOK_PK] = $this -> getOneInfor(FIELD_BOOK_PK, FIELD_BOOK_ISBN, htmlspecialchars($_POST[NEWBOOK_ISBN]));
             
            $book[FIELD_BOOK_AMOUNT] = $_POST[NEWBOOK_AMOUNT] + $this -> getOneInfor(FIELD_BOOK_AMOUNT, FIELD_BOOK_ISBN, htmlspecialchars($_POST[NEWBOOK_ISBN]));
             
            return $this -> updateInfor($book);
         
        }
         
         
        if(!(isset($_POST[NEWBOOK_NAME]) && $_POST[NEWBOOK_NAME] !== '')) return "图书名不能为空！";
        if(!(isset($_POST[NEWBOOK_AUTHOR]) && $_POST[NEWBOOK_AUTHOR] !== '')) return "作者名不能为空！";
        if(!(isset($_POST[NEWBOOK_TYPE]) && $_POST[NEWBOOK_TYPE] !== '')) return "图书类型不能为空！";
        if(!(isset($_POST[NEWBOOK_PUBLISHER]) && $_POST[NEWBOOK_PUBLISHER] !== '')) return "出版社不能为空！";
        if(!(isset($_POST[NEWBOOK_DATE]) && $_POST[NEWBOOK_DATE] !== '')) return "出版日期不能为空！";
        if(!(isset($_POST[NEWBOOK_INTRO]) && $_POST[NEWBOOK_INTRO] !== '')) return "图书简介不能为空！";
        if(!(isset($_POST[NEWBOOK_COST]) && $_POST[NEWBOOK_COST] !== '')) return "图书成本不能为空！";
        if(!(isset($_POST[NEWBOOK_PRICE]) && $_POST[NEWBOOK_PRICE] !== '')) return "图书价格不能为空！";
        
        // 封面图片文件上传合法性检测
         
        $allowedExts = array("gif", "jpeg", "jpg", "png");
         
        $temp = explode(".", $_FILES[NEWBOOK_COVER]["name"]);
        
        // 图片扩展名
        $extension = end($temp);
         
        if ((($_FILES[NEWBOOK_COVER]["type"] == "image/gif")
             
          || ($_FILES[NEWBOOK_COVER]["type"] == "image/jpeg")
           
          || ($_FILES[NEWBOOK_COVER]["type"] == "image/jpg")
           
          || ($_FILES[NEWBOOK_COVER]["type"] == "image/pjpeg")
           
          || ($_FILES[NEWBOOK_COVER]["type"] == "image/x-png")
           
          || ($_FILES[NEWBOOK_COVER]["type"] == "image/png"))
           
          && ($_FILES[NEWBOOK_COVER]["size"] < 2000000)
           
          && in_array($extension, $allowedExts)) 
           
        {
               
            if ($_FILES[NEWBOOK_COVER]["error"] > 0) {
                 
                return $_FILES[NEWBOOK_COVER]["error"];
                 
            }  
        
        }
        else {
             
            return "Invalid file";
             
        }
        
        $bookID = $this -> getAutoincrement();
        
        // 图书封面图片重新命名
        $bookFullName = $bookID . "." . $extension;
         
        // 将表单信息特殊字符转码并存入数组
        $newBookInfor = array(
         
            FIELD_BOOK_ID => $bookID,
            
            FIELD_BOOK_ISBN => htmlspecialchars($_POST[NEWBOOK_ISBN]),

            FIELD_BOOK_NAME => htmlspecialchars($_POST[NEWBOOK_NAME]),

            FIELD_BOOK_AUTHOR => htmlspecialchars($_POST[NEWBOOK_AUTHOR]),

            FIELD_BOOK_TYPE => htmlspecialchars($_POST[NEWBOOK_TYPE]),

            FIELD_BOOK_PUBLISHER => htmlspecialchars($_POST[NEWBOOK_PUBLISHER]),

            FIELD_BOOK_DATE => htmlspecialchars($_POST[NEWBOOK_DATE]),

            FIELD_BOOK_INTRO => htmlspecialchars($_POST[NEWBOOK_INTRO]),
            
            // 封面图片路径用 config 中定义的常量，那是本地 C 盘下目录
            FIELD_BOOK_COVER => "public/images/books/" . $bookFullName,

            FIELD_BOOK_COST => htmlspecialchars($_POST[NEWBOOK_COST]),
            
            FIELD_BOOK_PRICE => htmlspecialchars($_POST[NEWBOOK_PRICE]),

            FIELD_BOOK_AMOUNT => htmlspecialchars($_POST[NEWBOOK_AMOUNT])
             
        );
         
        // 执行上架
        $status = $this -> insertInfor($newBookInfor);
        
        if(is_int($status) && $status > 0) { // 上架成功
        
            // 把图片放到网站目录
            move_uploaded_file($_FILES[NEWBOOK_COVER]["tmp_name"], IMAGE_BOOK_PATH . $bookFullName);
            
            $status = "上架成功！";
        
        }
        
        // 返回状态信息
        return $status;
         
    }
    
    
    /**
     
     * 根据图书主键修改图书售价
     
     */
    
    public function editBookPrice() {
    
        // 接收要编辑的图书的参数 isset 函数防构造请求
        if(!(isset($_POST[EDIT_BOOK_PK]) && $_POST[EDIT_BOOK_PK] !== '')) return "没有指定要编辑的图书的主键，疑似伪造请求";
        if(!(isset($_POST[EDIT_BOOK_PRICE]) && $_POST[EDIT_BOOK_PRICE] !== '')) return "图书售价为必填信息！";
        
        // 信息更新列表
        $bookInfor = array(
            
            FIELD_BOOK_PK => htmlspecialchars($_POST[EDIT_BOOK_PK]),
            
            FIELD_BOOK_PRICE => htmlspecialchars($_POST[EDIT_BOOK_PRICE])
        
        );
        
        // 执行更新并返回结果
        return $this -> updateInfor($bookInfor);
    
    }
    
}
    