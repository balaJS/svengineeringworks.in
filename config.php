<?php
if($_SERVER['HTTP_HOST']=='localhost'){
	$serverName='localhost';
	$userName='root';
	$password='';
	$database='svengine_core';

/** Set global values open here **/
define('baseUrl','//localhost/projects/svengineeringworks.in');
define('resourceUrl','//localhost/projects/svengineeringworks.in/resources');
/** Set global values close here **/
}else{
	$serverName='localhost';
	$userName='svengine_wp737';
	$password='!87nSpG)B8';
	$database='svengine_core';

/** Set global values open here **/
define('baseUrl','//svengineeringworks.in');
define('resourceUrl','//resources.svengineeringworks.in');
/** Set global values close here **/
}

try {

  $conn = new PDO("mysql:host=$serverName;dbname=$database", $userName, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    

}catch(PDOException $e){

  echo "Connection failed: " . $e->getMessage();

}
/** DB config close **/
$email='vvbala1995@gmail.com';
$mobile1='9843317798';

?>