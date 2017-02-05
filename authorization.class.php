<?php

class Authorization {
  private $_value;
  private $_query;
  private $array=array();
private $_connection;
    private static $_singleton;
  private $_host = "localhost";
    private $_username = "root";
    private $_password = "";
    private $_database = "users";
 
 
public function   __construct(){
$this->_connection=new mysqli( $this->_host,
            $this->_username,
            $this->_password,
            $this->_database);
if ($this->_connection->connect_error){
       throw new Exception("Could not connect to Database.");
   }
              }
 private function __clone(){}
 
public static function getInstance(){
    if(!self::$_singleton){
        self::$_singleton= new self;
    }
        return self::$_singleton;
    }
    public function query($sql){
$this->_query=$this->_connection->query($sql);
return $this->_query;
    }
        public  function check($value){
              if(is_numeric($value)){
    $value=(int)$value;
    $value=md5($value);
    $value=strip_tags(trim($value));
   
            }
            if(is_string($value)){
    $value=strip_tags(trim($value));
    $value=(string)$value;

  }
    return $value;
  
}
public function escapeString($value){
  return $this->_connection->real_escape_string($value);
}
public function checkEmail($email)
{
  if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    die("Incorrect email"); 
  else  return $email;  
} 

}
 

?>
