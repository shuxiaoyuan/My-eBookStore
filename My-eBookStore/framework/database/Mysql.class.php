<?php

/**

 * framework/database/Mysql.class.php

 * 建立数据库连接

 * 封装对数据库的基本操作给 Model 基类使用

 */


/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../index.php");
    
    exit;
    
}


class Mysql {
    
    public $conn = false; // 数据库连接
    protected $sql;          // sql 语句
    
    /**

     * 数据库连接构造方法
     
     * 根据 application/config/config.php 中的内容设置数据库连接的默认参数

     */
    public function __construct() {
        
        //连接数据库
        $this -> conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        
        //检测连接
        if(mysqli_connect_errno($this -> conn)) {
            
            echo "Failed to connect to MySQL: " . $mysqli_connect_error();
            
        } 
        
        // 设置数据库的字符集
        mysqli_set_charset($this -> conn, DB_CHARSET);
        
    }
    
    
    /**

     * 执行 sql 语句

     * 并返回执行结果（一个对象或 TRUE、False）

     */
     
    public function query($sql) {
         
        $this -> sql = $sql;      
         
        //面向过程数据库查询语句
        $result = mysqli_query($this -> conn, $this -> sql);
         
        if(!$result) {
            
            die("Errorcode: " . mysqli_errno($this -> conn));
        }
         
        return $result;
    }
    
    
    
    /**
    
     * 获取查询结果模块

     * 用于将查询结果组织成各种形式
    
     * 例如按行、按列、所有、单个 来返回值
    
     */

    
    /* 取得查询结果一个值，并以字符串形式返回 */  
    
    public function getOne($sql) {
        
        $result = $this -> query($sql);
        
        $row = mysqli_fetch_row($result);
        
        if($row) {
            return $row[0];
        }
        else {
            return false;
        }
    }
    
    
    /* 以一维关联数组形式返回结果 */
    
    public function getRow($sql) {
        
        if($result = $this -> query($sql)) {
            
            $row = mysqli_fetch_assoc($result);
            
            return $row;
            
        }
        else {
            
            return false;
        }
    }
    
    
    /* 以二维关联数组形式返回结果 */
    
    public function getAll($sql) {

        $result = $this->query($sql);

        $list = array();

        while ($row = mysqli_fetch_assoc($result)) {

            $list[] = $row;

        }

        return $list;

    }
    
    
    /* 获取插入 ID */
    
    public function getInsertId() {

        return mysqli_insert_id($this->conn);

    }
    
    
    /* 按列 、获取错误信息等 */
    
}