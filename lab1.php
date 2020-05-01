<?php 

include_once "DBConnector.php";
include_once "user.php";
$conn= new DBConnector;

   if(isset ($_POST['btn_save']))
   {
   	$first_name=$_POST ['first_name'];
   	$last_name=$_POST ['last_name'];
   	$city=$_POST ['city_name'];
   	$username=$_POST['username'];
   	$password=$_POST['password'];

   	$user= new User($first_name, $last_name, $city, $username, $password);
   	if(!$user->validateForm())
   	{
   		$user->createFormErrorSessions();
   		header ("Refresh:0");
   		die();
   	}

   	$res = $user->save();

   	 if($res)
   	 {
   	 	echo "Save operation was successful";
   	 }
   	else
   	{
   		echo "An error occured";
   	}
   //	$con->closeDatabase();
   }
?>
<html>
<head>
   <title>Title goes here</title>
   <script type="text/javascript" src="validate.js"></script>
   <link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
  <form method="post" action="<?=$_SERVER['PHP_SELF']?>" name="user_datails" id="user_details" onsubmit="return validateForm()">
     <table align="center">
     	<tr>
     		<td> 
     			<div id="form-errors">
     				<?php 
     				session_start();
     				if(!empty($_SESSION['form_errors']))
     				{
     					echo " ".$_SESSION['form_errors'];
     					unset($_SESSION['form_errors']);
     				}
     				?>
     			</div>
     		</td>
     	</tr>
     <tr>
     <td><input type="text" name="first_name" required placeholder="first name"/></td>
     </tr>
     <tr>
     <td><input type="text" name="last_name" required placeholder="last name"/></td>
     </tr>
     <tr>
     <td><input type="text" name="city_name" required placeholder="city name"/></td>
     </tr>
     <tr>
     <td><input type="text" name="username" required placeholder="Username"/></td>
     </tr>
     <tr>
     <td><input type="password" name="password" required placeholder="password"/></td>
     </tr>
     <tr>
     <td><button type="submit" name="btn_save"><strong>SAVE</strong></button></td>
     </tr>
     <tr>
     	<td>
     		<a href="login.php">login</a>
     	</td>
     </tr>
     </table>
  </form>
</body>
</html>