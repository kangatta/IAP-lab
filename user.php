<?php
include "Crud.php";
include "authenticator.php";
require_once "DBConnector.php";

 class User implements Crud, Authenticator
 {
    private $user_id;
    private $first_name;
    private $last_name;
    public $city_name;

    private $username;
    private $password;


    function __construct($first_name, $last_name, $city_name, $username, $password)
    {
    	$this->first_name=$first_name;
    	$this->last_name=$last_name;
    	$this->city_name=$city_name;
    	$this->username=$username;
    	$this->password=$password;
    }

        //username setter
    public function setUsername($username)
    {
    	$this->username=$username;
    }
    //username getter
    public function getUsername()
    {
    	return $this->$username;
    }
    //pass setter
    public function setPassword($password)
    {
    	$this->password=$password;
    }
    //pass getter
    public function getPassword()
    {
    	return $this->password;
    }
    public function setUserId()
    {
    	$this->user_id=$user_id;
    }
    public function getUserId()
    {
    	return $this->$user_id;
    }

    public static function create()
    {
    	$instance=new self();
    	return $instance;
    }

    public function save()
    { 

    	$fn=$this->first_name;
    	$ln=$this->last_name;
    	$city=$this->city_name;

    	$uname=$this->username;
    	$this->hashPassword();
    	$pass=$this->password;

         $sql = "INSERT INTO `user`(`first_name`, `last_name`, `city_name`, `username`, `password`) 
                VALUES ('$fn', '$ln', '$city', '$uname', '$pass')";
        $DBConnector = new DBConnector;
        $res = mysqli_query($DBConnector->conn, $sql);
        return $res;
    }

    public function readAll()
    {
    	$sql = "SELECT * FROM `user`";
        $DBConnector = new DBConnector;
        $res = mysqli_query($DBConnector->conn, $sql);
        $DBConnector->closeDatabase();
        return $res;
    }
    public function readUnique()
    {
    	return null;
    }
    public function search()
    {
    	return null;
    }
    public function update()
    {
    	return null;
    }
    public function removeOne()
    {
    	return null;
    }
    public function removeAll()
    {
    	return null;
    }

    public function validateForm()
    {
    	$fn=$this->first_name;
    	$ln=$this->last_name;
    	$city=$this->city_name;

    	  if($fn=="" || $ln=="" || $city=="")
    	  {
    	  	return false;
    	  }
    	  return true;
    }

    public function createFormErrorSessions()
    {
    	session_start();
    	$_SESSION['form_errors'] = "All fields are required";
    }
    public function hashPassword()
    {
    	$this->password= password_hash($this->password, PASSWORD_DEFAULT);
    }
    public function isPasswordCorrect()
    {
    	$con= new DBConnector;
    	$found=false;
    	$res=mysql_query("SELECT * FROM user") or die("ERROR".mysql_error());

    	while($row=mysql_fetch_array($res))
    	{
    		if(password_verify($this->getPassword(), $row['password']) && $this->getUsername()==$row['username'])
    		{
    			$found=true;
    		}
    	}
    	$con->closeDatabase();
    	return $found;
    }
    public function login()
    {
    	if($this->isPasswordCorrect())
    	{
    		header("Location:private_page.php");
    	}
    }
    public function createUserSession()
    {
    	session_start();
    	$_SESSION['username']=$this->getUsername();
    }
    public function logout()
    {
    	session_start();
    	unset($_SESSION['username']);
    	session_destroy();
    	header("Location:lab1.php");
    }
 }
?>