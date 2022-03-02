<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   return $data;
	}

	$email = validate($_POST['email']);
	$pass = validate($_POST['password']);

	if (empty($email)) {
		header("Location: index.php?error=Email is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{

		if(strval($email)=="admin@admin.com" && strval($pass)=="admin"){
		header("Location: admin.php");
		exit();
		}
		// hashing the password
        $pass = md5($pass);

        
		$sql = "SELECT * FROM PASSENGER WHERE passengerEmail='$email' AND passengerPassword='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            
            	$_SESSION['email'] = $row['passengerEmail'];
            	$_SESSION['firstName'] = $row['passengerFN'];
            	$_SESSION['lastName'] = $row['passengerLN'];
            	$_SESSION['id'] = $row['passengerID'];
            	header("Location: home.php");
		        exit();
            
		}else{
			header("Location: index.php?error=Incorect email or password");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}
?>