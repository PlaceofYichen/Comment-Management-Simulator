<?php

//PDO方式

/**
 * 连接数据库 PDO
 * @return unknown
 */

class Dt{ 
    function connent()
    {
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_DATABASE;
        $dbh = new PDO($dsn, DB_USERNAME, DB_PASSWORD);      
        return $dbh;
    }

    /**
     * 新增数据
     *
     * @param string $table            
     * @param string $array            
     */
    function insert($table, $array)
    {
        $str = null;
        foreach ($array as $key => $val) {
            if ($str == null) {
                $sep = "";
            } else {
                $sep = ",";
            }
            $str .= $sep ."`" .  $key . "`";
        }
        
        $vals = "'" . join("','", array_values($array)) . "'";
        $sql = "insert into {$table}({$str}) values({$vals})";

        $pdo = $this->connent();

        $count = $pdo->exec($sql);
        $insertID = $pdo->lastInsertId();

        $pdo = null;
        return $insertID;   //返回新增记录的id
    }

    /**
     * 修改数据
     *
     * @param string $table            
     * @param string $array            
     * @param string $where            
     * @return boolean
     */
    function update($table, $array, $where = null)
    {
        $str = null;
        foreach ($array as $key => $val) {
            if ($str == null) {
                $sep = "";
            } else {
                $sep = ",";
            }
            $str .= $sep ."`" .  $key . "`='" . $val . "'";
        }
        $sql = "update {$table} set {$str} " . ($where == null ? null : " where " . $where);

        $pdo = $this->connent();
        $count = $pdo->exec($sql);
        $pdo = null;

        return $count;   //返回影响行数
    }

    /**
     * 删除数据
     *
     * @param string $table            
     * @param string $where            
     * @return number
     */
    function delete($table, $where = null)
    {
        $where = $where == null ? null : " where " . $where;
        $sql = "delete from {$table} {$where}";   

        $pdo = $this->connent();
        $count = $pdo->exec($sql);
        $pdo = null;

        return $count;   //返回影响行数
    }

    /**
     * 得到一条记录
     *
     * @param string $sql            
     * @param string $result_type            
     * @return multitype:
     */
    function fetchOne($sql)
    {
        $pdo = $this->connent();
        $result = $pdo->prepare($sql);     // prepare()方法准备查询语句
        $result->execute();                // execute()方法执行查询语句，并返回结果集
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $pdo = null;
        return $row;
    }

    /**
     * 得到结果集的所有记录
     *
     * @param string $sql            
     * @param string $result_type            
     * @return multitype:
     */
    function fetchAll($sql)
    {
        $rows = array();

        $pdo = $this->connent();
        $result = $pdo->prepare($sql);     // prepare()方法准备查询语句
        $result->execute();                // execute()方法执行查询语句，并返回结果集
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        return $rows;
    }

    /**
     * 得到结果集的记录数量
     *
     * @param string $sql            
     * @return number
     */
    function getResultNum($sql)
    {
        $pdo = $this->connent();

        $result = $pdo->query($sql);
        $row_count = $result->rowCount();
        
        return $row_count;
    }

    /**
     * 获取新增ID
     *
     * @param            
     *
     * @return number
     */
    function getInsertId()
    {
        return mysql_insert_id();
    }
}