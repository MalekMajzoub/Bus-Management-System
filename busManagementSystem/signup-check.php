<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['email']) && isset($_POST['password'])
    && isset($_POST['firstName']) && isset($_POST['lastName'])
	&& isset($_POST['phoneNb']) && isset($_POST['DOB']) && isset($_POST['re_password'])) {

	function trimming($data){
       $data = trim($data);
	   return $data;
	}

	$email = trimming($_POST['email']);
	$pass = trimming($_POST['password']);

	$re_pass = trimming($_POST['re_password']);
	$firstName = trimming($_POST['firstName']);
	$lastName = trimming($_POST['lastName']);
	$phoneNb = trimming($_POST['phoneNb']);
	$DOB = $_POST['DOB'];

	$user_data = 'Email'. $email. '&name='. $firstName . $lastName;


	if (empty($email)) {
		header("Location: signup.php?error=Email is required&$user_data");
	    exit();
	}else if(empty($pass)){
        header("Location: signup.php?error=Password is required&$user_data");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: signup.php?error=Re Password is required&$user_data");
	    exit();
	}

	else if(empty($firstName)){
        header("Location: signup.php?error=First Name is required&$user_data");
	    exit();
	}

	else if(empty($lastName)){
        header("Location: signup.php?error=Last Name is required&$user_data");
	    exit();
	}

	else if(empty($phoneNb)){
        header("Location: signup.php?error=Phone Number is required&$user_data");
	    exit();
	}

	else if(empty($DOB)){
        header("Location: signup.php?error=Date Of Birth is required&$user_data");
	    exit();
	}

	else if($pass !== $re_pass){
        header("Location: signup.php?error=The confirmation password does not match&$user_data");
	    exit();
	}

	else{

		// hashing the password
        $pass = md5($pass);

	    $sqlEmail = "SELECT * FROM PASSENGER WHERE passengerEmail='$email' ";
		$resultEmail = mysqli_query($conn, $sqlEmail);

	    $sqlPhone = "SELECT * FROM PASSENGER WHERE passengerPhone='$phoneNb' ";
		$resultPhone = mysqli_query($conn, $sqlPhone);

		if (mysqli_num_rows($resultEmail) > 0) {
			header("Location: signup.php?error=The email is taken try another&$user_data");
	        exit();
		}else if (mysqli_num_rows($resultPhone) > 0) {
			header("Location: signup.php?error=Phone Number is already registered&$user_data");
	        exit();
		}else {
           $sql2 = "INSERT INTO PASSENGER(passengerEmail, passengerPassword, passengerFN, passengerLN ,passengerDOB, passengerPhone) 
		   VALUES('$email', '$pass', '$firstName', '$lastName' ,'$DOB' , $phoneNb)";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
           	 header("Location: index.php?success=Your account has been created successfully");
	         exit();
           }else {
	           	header("Location: signup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
	
}else{
	header("Location: signup.php");
	exit();
}
?>