<?php

class mysql {
    private $logfilepath;
    private $is_log;
    private $hlog;
    public $conn;

    //构造函数
    public function __construct()
    {
        $config = array(
            'DB_TYPE' => 'mysql',
            'DB_HOST' => 'localhost',
            'DB_NAME' => 'xss', 
            'DB_USER' => 'root',
            'DB_PASS' => 'root',
            'DB_CHARSET' => 'utf8',
        );

        $this->conn = $this->connect($config['DB_HOST'],$config['DB_USER'],$config['DB_PASS'],$config['DB_NAME'],$config['DB_CHARSET']);
    }

    //连接数据库
    public function connect($dbhost, $dbuser, $dbpass, $dbname, $dbcharset)
    {
        $this->conn = @mysql_connect($dbhost,$dbuser,$dbpass);
        if (!$this->conn) {
            die("连接数据库失败：".mysql_error());
        } else {
            if (!@mysql_select_db($dbname)) {
                die("连接数据库成功，但选择数据库失败：".mysql_error());
            }
        }

        @mysql_query("set names ".$dbcharset);
    }

    //执行语句
    public function query($sql){
        
        $result = @mysql_query($sql);

        if (!$result) {
            die('mysql_query error:'.mysql_error());
        }

        return $result;
    }

    //查询一条数据
    public function select_one($tab,$column = "*",$condition = '',$debug=False)   //查询函数
    {
        // echo $condition;
        $condition = $condition ? ' ' . $condition : NULL;
        $sql = "select $column from $tab $condition ";
        if ($debug) {
            echo '将执行语句：'.$sql.'<br />';
        } else {
            $result = $this->query($sql);
            $row = @mysql_fetch_assoc($result);
            return $row;
        }
    }

    //查询多条数据
    public function select_more($tab,$column = "*",$condition = '',$debug=False)   //查询函数
    {
        $condition = $condition ? ' '.$condition : NULL;
        $sql = "select $column from $tab $condition";

        $result = $this->query($sql);
        $i = 0;
        $rows = array();
        while ($row = @mysql_fetch_assoc($result)) {
            $rows[$i] = $row;
            // print_r($rows[$i]);
            $i++; 
        }
        return $rows;
    }

    //返回结果集
    public function echo_result($tab,$column = "*",$condition = '',$debug=False)   //查询函数
    {
        $condition = $condition ? ' where ' . $condition : NULL;
        $sql = "select $column from $tab $condition ";
        if ($debug) {
            echo '将执行语句：'.$sql.'<br />';
        } else {
            return $this->query($sql);
        }
    }

    //插入数据
    public function insert($tab,$arr,$debug=False)
    {
        $value = '';
        $column = '';
        foreach ($arr as $k => $v) {
            $column .= ",{$k}";
            $value .= ",'{$v}'";
        }
        $column = substr($column, 1);
        $value = substr($value, 1);

        $sql = "insert into $tab($column) values($value)";
        if ($debug) {
            echo '将执行语句：'.$sql;
        } else {
            $this->query($sql);
            $num = $this->affected_num();

            return $num;    //返回受影响行数
        }
    }

    //获取最后插入的id
    public function insert_id() {
        $id = mysql_insert_id($this->link_id);

        return $id;
    }

    //更新数据
    public function update($tab,$arr,$condition = '',$debug=False)
    {
        if (!$condition) {
            die("error".mysql_error());
        } else {
            $condition = ' ' . $condition;
        }
        
        $value = '';
        foreach ($arr as $k => $v) {
            $value .= "{$k}='{$v}',";
        }
        $value = substr($value,0,-1);

        $sql = "update $tab set $value $condition";
        if ($debug) {
            echo '将执行语句：'.$sql;
        } else {
            $this->query($sql);
            $num = $this->affected_num();

            return $num;            
        }
    }

    //删除数据
    public function delete($tab,$condition='',$debug=False)
    {
        $condition = $condition ? ' '. $condition : NULL;
        $sql = "delete from $tab $condition";
        if ($debug) {
            echo '将执行语句：'.$sql;
        } else {
            $this->query($sql);
            $num = $this->affected_num();

            return $num;    //返回受影响行数
        }
    }

    //返回受影响行数
    public function affected_num()
    {
        $num = @mysql_affected_rows();
        return $num;
    }

    //关闭数据库连接
    public function close()
    {  
        mysql_close($this->conn);
        // mysql_close();
    }

    //析构函数
    public function __destruct()
    {
        if($this->is_log){
            fclose($this->hlog);
        }
    }
}

?>