<?php
define('DB_HOST', 'localhost'); // Database server
define('DB_USER', 'root'); // Database username
define('DBPASSWORD', ''); // Database password
define('DBNAME', 'brewery_db'); // Database name

$servername = "localhost";
$username = "root";
$password = '';
$dbname = "brewery_db";
$db = mysqli_connect($servername, $username, $password, $dbname, "3307");

// Check db connection
if($db === false){
    die("Error: connection error. " . mysqli_connect_error());
}
?>