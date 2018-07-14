<?php

/**

* framework/core/Model.class.php

* 模型基类

* 对 sql 语句进行封装，以及对模型数据进行增删改查等操作

*/


/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../index.php");
    
    exit;
    
}


class Model {
    
    public $db; // 数据库连接对象引用
    
    protected $table; // 模型对应的数据库中的表
    
    protected $fields = array(); // 表中所有的字段
    
    public function __construct($table) {
        
        // 创建数据库连接对象
        $this -> db = new Mysql();
        
        // 初始化模型对应的表名
        $this -> table = $table; 
        
        // 获取表的所有字段
        $this -> getFields();
        
    }
    
    
    
    /**

     * 获取表的所有字段

     * 找到主键（如果存在的话）

     */
     
    private function getFields() {
        
        $sql = "DESC " . $this -> table;
        
        $result = $this -> db -> getAll($sql);
        
        foreach ($result as $v) {
            
            $this -> fields[] = $v['Field'];
            
            if($v['Key'] == 'PRI') {
                
                // 如果存在主键，将主键所在的字段名存于 $pk 中
                $pk = $v['Field'];
                
            }
            
            // 如果存在主键，将主键所在的字段名存到字段数组中
            if (isset($pk)) {

                $this->fields['pk'] = $pk;

            }
            
        }
        
    }
    
    
    
    /**
    
     * 模型数据查询模块
    
     * 已知 $key 字段的值 $value 查询 $object 字段的值
    
     * $object 默认为所有记录 返回查询所用的 $sql 语句
    
     */
    
    protected function querySql($object = '*', $key = '', $value = '', $offset = '', $limit = '') {
        
        // 若 $object 是数组
        if(is_array($object)) {
            
            $tmp = "";
            
            foreach($object as $v) {
                
                // 判断要查询的字段是否在本表的字段列表中
                if (in_array($v, $this->fields)) {
                    
                    $tmp .= $v . ",";
                }
                
            }
            
            $object = rtrim($tmp, ',');
            
        }
        
        $sql = "SELECT $object FROM `{$this->table}`";
        
        // 注意，数据库查询判空也要考虑查询 0 的问题
        
        if($key !== '' && $value !== '') {
            
            $sql .= " WHERE $key = '$value'";
            
        }
        
        if(isset($this->fields['pk'])) {
            
            $sql .= " ORDER BY `{$this->fields['pk']}` DESC";
            
        }
        
        if($offset !== '' && $limit !== '') {
            
            $sql .= " LIMIT $offset, $limit";
            
        }
        
        //echo $sql;
        
        return $sql;
        
    } 
    

    /* 返回多个实例模型的多个信息或单个信息 */
    
    public function getSomeInfor($infor, $offset, $limit, $key = '', $value = '') {
        
        // $infor 为空或 * ，以二维数组形式返回多个实例模型的所有信息
        if($infor === '' || $infor === '*') {
            
            return $this -> db -> getAll($this -> querySql('*', $key, $value, $offset, $limit));
            
        }
        
        // $infor 为数组或单个变量，以二维数组形式返回多个实例模型的多个信息或单个信息
        else {
        
            return $this -> db -> getAll($this -> querySql($infor, $key, $value, $offset, $limit));
            
        }
        
    }
    

    /* 根据实例模型某个字段的名和值返回这个实例模型的多个信息或单个信息 */
    
    public function getOneInfor($infor, $fieldName, $fieldValue) {
        
        // $infor 为空或 * ，以一维数组形式返回此用户的所有信息
        if($infor === '' || $infor === '*') {
            
            return $this -> db -> getRow($this -> querySql('*', $fieldName, $fieldValue));
            
        }
        
        // $infor 为数组，以一维数组形式返回此用户的多个信息
        else if(is_array($infor)) {
        
            return $this -> db -> getRow($this -> querySql($infor, $fieldName, $fieldValue));
            
        }
        
        // $infor 为单个变量，以字符串形式返回此用户的单个信息
        else {
          
            return $this -> db -> getOne($this -> querySql($infor, $fieldName, $fieldValue));
            
        }
        
    }
    
    
    /* 查询表中数据的条数 */

    public function getInforTotal($fieldName = '', $fieldValue = '') {

        $sql = "select count(*) from {$this->table}";
        
        if($fieldName !== '') {
            
            $sql .= " WHERE $fieldName = '$fieldValue'";
            
        }
        
        return $this->db->getOne($sql);

    }
    
    
    
    /* 已知某个字段的值根据主键是否存在判断是否存在此条记录 */
    
    public function hasInfor($fieldName, $fieldValue) {
        
        if(!($this -> getOneInfor($this->fields['pk'], $fieldName, $fieldValue))) {
            
            return false;
            
        }
        else {
            
            return true;
            
        }
        
    }
    
    
    /**
    
     * 模型数据添加模块
    
     * @param $insert_list 要插入的记录，关联数组的形式
    
     */
    
    public function insertInfor($insert_list) {
        
        $field_list = '';  // 字段列表
        
        $value_list = '';  // 值列表

        foreach ($insert_list as $k => $v) {
            
            // 判断要插入的字段是否在本表的字段列表中
            if (in_array($k, $this->fields)) {
                
                $field_list .= "`".$k."`" . ',';

                $value_list .= "'".$v."'" . ',';
                
            }

        }
        
        // 去掉语句末尾的逗号

        $field_list = rtrim($field_list,',');

        $value_list = rtrim($value_list,',');
        
        
        // 完整插入语句
        $sql = "INSERT INTO `{$this->table}` ({$field_list}) VALUES ({$value_list})";
        
        if ($this->db->query($sql)) {

            // 插入成功，返回插入 ID
            return $this -> db -> getInsertId();

        }
        else {

            // 插入失败
            return false;

        }
        
    }
    
    
    /* 获取自增的字段(id) */
    
    public function getAutoIncrement() {
        
        $sql = "SHOW TABLE STATUS LIKE '{$this -> table}'";
        
        $row = $this -> db -> getRow($sql);
        
        if(isset($row['Auto_increment'])) {
            
            return $row['Auto_increment'];
            
        }
        else {
            
            return false;
            
        }
        
    }
    
    
    /**
    
     * 模型数据删除模块
    
     * @param $pk 要删除的记录的主键（一般是 id）
    
     */
    
    public function deleteInfor($pk) {

        $where = 0; // 条件语句

        // 检查 $pk是否为数组 
        if (is_array($pk)) {

            $where = "`{$this->fields['pk']}` in (" . implode(',', $pk) . ")";

        }
        
        // $pk 为单个变量
        else {

            $where = "`{$this->fields['pk']}`=$pk";

        }

        // 构造删除记录的 sql 语句

        $sql = "DELETE FROM `{$this->table}` WHERE $where";

        if ($this->db->query($sql)) {

            // 删除成功，返回影响的行数

            if ($rows = mysqli_affected_rows($this -> db -> conn)) {

                return $rows;

            }
            else {

                // 没有实际删除任何记录
                return false;

            }        

        }
        else {

            // 删除失败
            return false;

        }

    }
    
    
    /**

     * 更新模型数据模块

     * @param $list 需要更新的数据，关联数组的形式

     * @return 更新成功则返回受影响的记录数，更新失败则返回 false

     */

    public function updateInfor($list) {

        $uplist = ''; // 需要更新的字段和更新值

        $where = 0;   // 需要更新的数据的位置

        foreach ($list as $k => $v) {
            
            // 判断要更新的字段是否在本表的字段列表中
            if (in_array($k, $this->fields)) {

                if ($k == $this->fields['pk']) {

                    // 找到主键字段作为 $where 语句

                    $where = "`$k`=$v";

                }
                else {

                    $uplist .= "`$k`='$v'".",";

                }

            }

        }

        // 去掉语句末尾的逗号

        $uplist = rtrim($uplist,',');

        // 构造 sql 语句

        $sql = "UPDATE `{$this->table}` SET {$uplist} WHERE {$where}";


        if ($this->db->query($sql)) {

            // 更新成功，返回受影响的记录数，若提交的信息和原来的相同的话则为 0，
            
            $rows = mysqli_affected_rows($this->db->conn);
            
            return $rows;

        }
        else {

            // 更新失败
            return false;

        }

    }
    
    
}
