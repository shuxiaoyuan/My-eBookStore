<?php

/**

* application/models/ViewModel.class.php

* 视图模型

* 对各种实例模型进行视图显示的封装

* 不直接与数据库交互，因此不继承自 model 基类

*/


/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../index.php");
    
    exit;
    
}

class ViewModel {
    
    public $model; // 实例模型
    
    public function __construct($model) {
        
        $this -> model = $model;
        
    }
    
    /**
     
     * 视图中的分页显示
     
     * @param $eachPageTotal 每页的信息条数
     
     * @param $key & $value 特定键值的信息，默认为空
     
     * @return : 二维关联数组形式返回信息 
     
     */
    public function getPageInfor($eachPageTotal, $key = '', $value = '') {

        // 根据传参确定是第几页
        $page = (isset($_POST['page']) && $_POST['page'] !== '') ? htmlspecialchars($_POST['page']) : 1;
            
        // 根据是第几页确定开始位置 从 0 开始
        if($page < 1) die("页数不能小于 1 ！"); //这个情况不用返回错误信息再载入错误页面了
        
        $start = ($page - 1) * $eachPageTotal;

        // 如果请求的开始位置（下标从 0 开始）比总数还大 说明是构造参数
        if($start >= ($this -> model -> getInforTotal())) {
            
            die("没有更多内容了。"); //这个情况不用返回错误信息再载入错误页面了
            
        }
        else {
            
            // $eachPageTotal 条某个实例模型的信息
            return $this -> model -> getSomeInfor('', $start, $eachPageTotal, $key, $value);
            
        }

        
    }
    
    
    /* 根据每页的记录条数查询共有多少页 */

    public function getPageTotal($eachPageTotal, $fieldName = '', $fieldValue = '') {

        return ceil(($this -> model -> getInforTotal($fieldName, $fieldValue)) / $eachPageTotal);

    }
    
    
    
    /**
     
     * 视图中的搜索框
     
     * @param $nameField : 传入的名称字段
     
     * @return : 一维关联数组
     
     */
    public function getSearchInfor($nameField) {
        
        // 用此方法前先核对好前端传送的 POST 数组下标的键名 
        if(isset($_POST['search_name']) && $_POST['search_name'] !== '') {
            
            $nameValue = htmlspecialchars($_POST['search_name']);
            
            $infor = $this -> model -> getOneInfor('', $nameField, $nameValue);;
            
            // 若存在此名字对应的信息
            if($infor) {

                return $infor;
               
            }
            else {
                
                die("没有找到。");
            
            }
            
        }
        else {
            
            die("没有提供要搜索的名字！");
            
        }
         
     }
    

}