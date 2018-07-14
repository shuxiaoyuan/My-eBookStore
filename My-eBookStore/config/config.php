<?php

/**

 * config/config.php

 * 网站配置设置文件

 */


/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../index.php");
    
    exit;
    
}



/** 

 * 定义网站域名 用于前端显示等

 */

define("DOMAIN", "http://127.0.0.1/");
//define("DOMAIN", "http://lishuyuan.imwork.net/");
//define("DOMAIN", "http://z16547g744.51mypc.cn/");


/**

 * 网站路径定义模块 

 * 注意，这些常量不可用于前端显示，否则暴露后台主机目录

 */

 
/* 定义根目录 */
define("DS", DIRECTORY_SEPARATOR); // 注意语法
define("ROOT", getcwd() . DS); // 注意语法


/* 定义根目录下的目录 */
define("APP_PATH", ROOT . 'application' . DS);
define("FRAMEWORK_PATH", ROOT . 'framework' . DS);
define("PUBLIC_PATH", ROOT . 'public' . DS);
define("CONFIG_PATH", ROOT . 'config' . DS);

/* 定义 APP_PATH 下的目录 */
define("CONTROLLER_PATH", APP_PATH . 'controllers' . DS);
define("MODEL_PATH", APP_PATH . "models" . DS);
define("VIEW_PATH", APP_PATH . "views" . DS);

/* 定义 FRAMEWORK_PATH 下的目录 */
define("CORE_PATH", FRAMEWORK_PATH . "core" . DS);
define('DB_PATH', FRAMEWORK_PATH . "database" . DS);

/* 定义 PUBLIC_PATH 下的目录 */
define("CSS_PATH", PUBLIC_PATH . "css" . DS);
define("IMAGE_PATH", PUBLIC_PATH . "images" . DS);
define("JS_PATH", PUBLIC_PATH . "js" . DS);
define("UPLOAD_PATH", PUBLIC_PATH . "uploads" . DS);

/* 定义 VIEW_PATH 下的目录 */
define("VIEW_ADMIN_PATH", VIEW_PATH . "admin" . DS);
define("VIEW_HOME_PATH", VIEW_PATH . "home" . DS);
define("VIEW_PUBLIC_PATH", VIEW_PATH . "public" . DS);

/* 定义 IMAGE_PATH 下的目录 */
define("IMAGE_BOOK_PATH", IMAGE_PATH . "books" . DS);


/**

 * 数据库默认配置设置模块 

 */


/* 数据库基本连接设置 */

define("DB_HOST", "localhost");
define("DB_USER", "my_ebookstore");
define("DB_PASSWORD", "my_ebookstore");
define("DB_NAME", "my_ebookstore");
define("DB_CHARSET", "utf-8");


/* 数据库表名设置 */

define("TABLE_USER", "user");
define("TABLE_ADMIN", "admin");
define("TABLE_BOOK", "book");
define("TABLE_MESSAGE", "message");
define("TABLE_ORDER", "orders");
define("TABLE_SHELF", "shelf");


/* 数据库各表字段设置 */

// TABLE_USER 中的字段
define("FIELD_USER_PK", "id"); //主键
define("FIELD_USER_ID", "id");
define("FIELD_USER_NAME", "username");
define("FIELD_USER_PASSWORD", "password");
define("FIELD_USER_NICKNAME", "nickname");
define("FIELD_USER_SEX", "sex");
define("FIELD_USER_MOBILE", "mobile");
define("FIELD_USER_ADDRESS", "address");
define("FIELD_USER_BALANCE", "balance");
define("FIELD_USER_REGISTERTIME", "register_time");

// TABLE_ADMIN 中的字段
define("FIELD_ADMIN_ID", "id");
define("FIELD_ADMIN_NAME", "name");
define("FIELD_ADMIN_PASSWORD", "password");

// TABLE_BOOK 中的字段
define("FIELD_BOOK_PK", "id"); //主键
define("FIELD_BOOK_ID", "id");
define("FIELD_BOOK_ISBN", "isbn");
define("FIELD_BOOK_TYPE", "type");
define("FIELD_BOOK_NAME", "name");
define("FIELD_BOOK_AUTHOR", "author");
define("FIELD_BOOK_PUBLISHER", "publisher");
define("FIELD_BOOK_DATE", "date");
define("FIELD_BOOK_INTRO", "intro");
define("FIELD_BOOK_COVER", "cover");
define("FIELD_BOOK_COST", "cost");
define("FIELD_BOOK_PRICE", "price");
define("FIELD_BOOK_AMOUNT", "amount");
define("FIELD_BOOK_SOLD", "sold");

// TABLE_BOOK 中的字段
define("FIELD_MESSAGE_PK", "id");
define("FIELD_MESSAGE_ID", "id");
define("FIELD_MESSAGE_UID", "uid");
define("FIELD_MESSAGE_TITLE", "title");
define("FIELD_MESSAGE_CONTENT", "content");
define("FIELD_MESSAGE_DATETIME", "datetime");

// TABLE_ORDER 中的字段
define("FIELD_ORDER_PK", "id");
define("FIELD_ORDER_ID", "id");
define("FIELD_ORDER_NUMBER", "number");
define("FIELD_ORDER_UID", "uid");
define("FIELD_ORDER_UNAME", "uname");
define("FIELD_ORDER_UMOBILE", "umobile");
define("FIELD_ORDER_UADDRESS", "uaddress");
define("FIELD_ORDER_BID", "bid");
define("FIELD_ORDER_BISBN", "bisbn");
define("FIELD_ORDER_BNAME", "bname");
define("FIELD_ORDER_BAMOUNT", "bamount");
define("FIELD_ORDER_BPRICE", "bprice");
define("FIELD_ORDER_STATE", "state");
define("FIELD_ORDER_TIME", "time");


// TABLE_SHELF 中的字段
define("FIELD_SHELF_PK", "id");
define("FIELD_SHELF_ID", "id");
define("FIELD_SHELF_UID", "uid");
define("FIELD_SHELF_BID", "bid");
define("FIELD_SHELF_BAMOUNT", "bamount");


/**

 * 前台表单设置模块 

 */
 
 
/* 用户登录表单 */

define("LOGIN_USERNAME", "login_username");
define("LOGIN_PASSWORD", "login_password");


/* 用户注册表单 */

define("REGISTER_USERNAME", "register_username");
define("REGISTER_PASSWORD", "register_password");
define("REGISTER_NICKNAME", "register_nickname");
define("REGISTER_MOBILE", "register_mobile");
define("REGISTER_ADDRESS", "register_address");
define("REGISTER_SEX", "register_sex");


/* 用户发表留言表单 */

define("MESSAGE_TITLE", "message_title");
define("MESSAGE_CONTENT", "message_content");


/* 用户信息编辑表单 */

define("EDIT_PK", "edit_pk"); // 修改密码也用此主键常量定义
define("EDIT_USERNAME", "edit_username");
define("EDIT_PASSWORD", "edit_password");
define("EDIT_NICKNAME", "edit_nickname");
define("EDIT_MOBILE", "edit_mobile");
define("EDIT_ADDRESS", "edit_address");
define("EDIT_SEX", "edit_sex");


/* 用户修改密码表单 */

define("OLD_PASSWORD", "old_password");
define("NEW_PASSWORD", "new_password");


/* 管理员登录表单 */

define("LOGIN_ADMINNAME", "login_adminname");
define("LOGIN_ADMINPASS", "login_adminpass");


/* 图书上架表单 */

define("NEWBOOK_ISBN", "newbook_isbn");
define("NEWBOOK_NAME", "newbook_name");
define("NEWBOOK_AUTHOR", "newbook_author");
define("NEWBOOK_TYPE", "newbook_type");
define("NEWBOOK_PUBLISHER", "newbook_publisher");
define("NEWBOOK_DATE", "newbook_date");
define("NEWBOOK_INTRO", "newbook_intro");
define("NEWBOOK_COVER", "newbook_cover");
define("NEWBOOK_COST", "newbook_cost");
define("NEWBOOK_PRICE", "newbook_price");
define("NEWBOOK_AMOUNT", "newbook_amount");

/* 图书调整售价表单 */

define("EDIT_BOOK_PK", "edit_book_pk");
define("EDIT_BOOK_PRICE", "edit_book_price");
