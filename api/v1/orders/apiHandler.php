<?php
 include_once'../../../DBConnector.php';
 class ApiHandler
 {
 	private $meal_name;
 	private $meal_units;
 	private $unit_price;
 	private $status;
 	private $user_api_key;

 	//getters and setters
 	public function setMealName($meal_name)
 	{
 		$this->meal_name=$meal_name;
 	} 
 	public function getMealName()
 	{
 		return $this->meal_name;
 	}
 	public function setMealUnits($meal_units)
 	{
 		$this->setMealUnits=$meal_units;
 	}
 	public function getMealUnits()
 	{
 		return $this->meal_units;
 	}
 	public function setUnitPrice($unit_price)
 	{
 		$this->setUnitPrice=$unit_price;
 	}
 	public function getUnitPrice()
 	{
 		return $this->unit_price;
 	}
 	public function setStatus($status)
 	{
 		$this->setStatus=$status;
 	}
 	public function getStatus()
 	{
 		return $this->status;
 	}
 	public function setUserApiKey($key)
 	{
 		$this->setUserApiKey=$key;
 	}
 	public function getUserApiKey()
 	{
 		return $this->key;
 	}
 	public function createOrder()
 	{
 		//save incoming order
         $sql = "INSERT INTO `orders`(`order_name`, `units`, `unit_price`, `order_status`) 
                VALUES ('$this->meal_name', '$this->meal_units', '$this->unit_price', '$this->status')";
        $DBConnector = new DBConnector;
        $res = mysqli_query($DBConnector->conn, $sql);
        return $res;
 	}

 	public function checkOrderStatus()
 	{}
 	public function fetchAllOrders()
 	{}
 	public function checkApiKey()
 	{
 		return true;
 	}
 	public function checkContentType()
 	{}

 }
?>