<?php

$sname= "localhost";
$username= "root";
$password = "root";
$db_name = "busManagementSystem";

$conn = new mysqli($sname, $username, $password, $db_name);

if (!$conn) {
	echo "Connection failed!". $conn->connect_error;
}
?>
