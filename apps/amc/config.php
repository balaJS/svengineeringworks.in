<?php

if($_SERVER['HTTP_HOST']=='localhost'){
	$serverName='localhost';
	$userName='root';
	$password='';
	$database='sv_amcdb';


/** Set global values open here **/
define('baseUrl','http://localhost/sites/amc-app');
define('resourceUrl','http://localhost/sites/amc-app');
/** Set global values close here **/
}else{
	$serverName='localhost';
	$userName='svengine_wp737';
	$password='!87nSpG)B8';
	$database='svengine_amc';

/** Set global values open here **/
define('baseUrl','https://svengineeringworks.in');
define('resourceUrl','https://svengineeringworks.in');
/** Set global values close here **/
}

/*try {
  $conn = new PDO("mysql:host=$serverName;dbname=$database", $userName, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
}catch(PDOException $e){
  echo "Connection failed: " . $e->getMessage();
}*/

$conn = mysqli_connect($serverName,$userName,$password,$database);

/** DB config close **/
?>