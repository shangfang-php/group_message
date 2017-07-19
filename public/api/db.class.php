<?php
class Db{
    private static $_instance = '';
    private $dbConn;
    private $host       =   'rm-wz989603379p1e0v6o.mysql.rds.aliyuncs.com';
    private $user       =   'root';
    private $password   =   '1qa2ws3edZXC';
    private $database   =   'group_message';
    private function __construct(){ //防止在外部实例化该类
        $this->dbConn = new mysqli($this->host, $this->user, $this->password, $this->database);
        if(!$this->dbConn){
            echo '数据库连接失败:'.$this->dbConn->connect_error;
        }
        $this->dbConn->query("set names utf8");
    }
    
    private function __clone(){}//禁止通过复制的方式实例化该类
        
    public static function getInstance(){
        if(self::$_instance == null){
            self::$_instance = new self();    
        }
        return self::$_instance;
    }
    
    public function fetch_all($sql){
        $result     = self::query($sql);
        $result_arr = array();
        while($query = $result->fetch_assoc()){
            $result_arr[]    = $query;
        }
        return $result_arr;//结果集以数组的形式返回
        
    }
    
    public function fetch($sql){
        $result     =   self::query($sql);
        $result_arr =   $result->fetch_assoc();
        return $result_arr;//结果集以数组的形式返回
    }
    
    public function query($sql){
        $result = $this->dbConn->query($sql);
        return $result;
    }
    
    public function close(){
        $this->dbConn->close(); ##关闭数据库
    }
}