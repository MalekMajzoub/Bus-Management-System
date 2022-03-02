<?php 
include_once 'db_conn.php';

if (isset($_POST['TLStart'])) {
	$query = "SELECT DISTINCT stopLocation 
	FROM TRAVELLINE NATURAL JOIN TRAVELLINESTOP NATURAL JOIN STOP 
	WHERE TLStart='".$_POST['TLStart']."'";
	$result = $conn->query($query);
	if ($result->num_rows > 0 ) {
			echo '<option selected disabled value="">Select Drop-Off Location</option>';
		 while ($row = $result->fetch_assoc()) {
		 	echo '<option value='.$row['stopLocation'].'>'.$row['stopLocation'].'</option>';
		 }
	}else{

		echo '<option>No Location Found!</option>';
	}

}
if (isset($_POST['TLEnd'])) {
	$query = "SELECT DISTINCT TimeFrom FROM TRAVELLINE";
	$result = $conn->query($query);
	if ($result->num_rows > 0 ) {
			echo '<option selected disabled value="">Select Reservation Time </option>';
		 while ($row = $result->fetch_assoc()) {
		 	echo '<option value='.$row['TimeFrom'].'>'.$row['TimeFrom'].'</option>';
		 }
	}else{
		echo '<option>No Location Found!</option>';
	}

}
?>