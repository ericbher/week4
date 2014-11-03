<?php

//link to the file which contains our host name, username, password, and database name

include_once '../sys/config/db-cred.inc.php';





// Define the constants for configuration info

foreach ( $conn as $name => $val )

{
	define($name, $val);
}



//Create a PDO object. This is just a syntax string for a PDO connection that will be plugged in below.

$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
$dbo = new PDO($dsn, DB_USER, DB_PASS);

//Define the auto-load function for classes

// function __autoload($class)
// {
// 	$filename = "../sys/class/class." . $class . ".inc.php";
// 	if ( file_exists($filename) )
// 	{
// 		include_once $filename;
// 	}
// }


?>