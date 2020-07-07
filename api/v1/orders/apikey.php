<?php
 include_once 'DBConnector.php';
 if($_SERVER['REQUEST_METHOD'] !=='POST')
 	{
 		//we do nit allow users to access this page via url
 		header('HTTP/1.0 403 Forbidden');
 		echo 'You are forbidden!!';
 	}
 	else
 	{
 		$api_key=null;
 		$api_key=generateApiKey(64);
 		header('Content-type: application/json');
 		echo generateResponse($api_key);

 	}

 		function generateApiKey($str_length)
 		{
 			$chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

 			$bytes=openssl_random_pseudo_bytes(3*$str_length/4+1);

 			$repl=unpack('C2', $bytes);

 			$first=$chars[$repl[1]%62];
 			$second=$chars[$repl[2]%62];
 			return strtr(substr(base64_encode($bytes),0, $str_length), '+/', "$first$second");
 		}
 		function saveApiKey()
 		{//write code to save api
 			//return true;
 		}
 		function generateResponse($api_key)
 		{
 			if(saveApiKey())
 			{
 				$res=['success'=>'message'=>$api_key];
 			}
 			else
 			{
 				$res=['success'=>'message'=>'something went wrong. Please regenerate the Api Key'];
 			}
 			return json_encode($res);
 		}
 	
 ?>