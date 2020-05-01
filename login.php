<?php 
 include_once 'DBConnector.php';
 include_once 'user.php';

  $con=new DBConnector;
  if(isset($_POST['btn_login']))
  {
  	$username=$_POST['username'];
  	$password=$_POST['password'];
  	$instance= User::create();
  	$instance->setPassword($password);
  	$instance->setUsername($username);

  	if($instance->isPasswordCorrect())
  	{
  		$instance->login();
  		$con->closeDatabase();
  		$instance->createUserSession();
  	}
  	else
  	{
  		$con->closeDatabase();
  		header("Location:login.php");
  	}
  }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Title goes here</title>
   <script type="text/javascript" src="validate.js"></script>
   <link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
  <form method="post" action="<?=$_SERVER['PHP_SELF']?>" name="login" id="login" >
    <table align="center">
     <tr>
     <td><input type="text" name="username" required placeholder="Username"/></td>
     </tr>
     <tr>
     <td><input type="password" name="password" required placeholder="password"/></td>
     </tr>
     <tr>
     <td><button type="submit" name="btn_login"><strong>LOGIN</strong></button></td>
     </tr>
    </table>
  </form>



</body>
</html>