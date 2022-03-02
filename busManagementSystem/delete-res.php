<?php
session_start(); 
include "db_conn.php";
$query = "SELECT * FROM ONLINETICKET WHERE passengerID=".$_SESSION['id'];
$result = $conn->query($query);
if ($result->num_rows > 0 ){

    $query1 = "SELECT ticketID FROM ONLINETICKET
	                WHERE passengerID=".$_SESSION['id']
                    ." AND CURRENT_TIMESTAMP() < ( SELECT resTimeFrom FROM ONLINETICKET WHERE passengerID=".$_SESSION['id']." ORDER BY resTimeFrom DESC LIMIT 1)
                    ORDER BY resTimeFrom DESC LIMIT 1";
    $result1 = $conn->query($query1);

    if ($result1->num_rows > 0 ){
            $row = $result1->fetch_assoc();

        $queryseat1 ="SELECT seatID FROM ONLINETICKET WHERE ticketID=".$row['ticketID'];
        $resultseat1 = $conn->query($queryseat1);
        $rowseat1 = $resultseat1->fetch_assoc();

        $queryseat2 = "UPDATE SEAT SET status=0
                        WHERE seatID=".$rowseat1['seatID'];
        $resultseat2 = $conn->query($queryseat2);

        $query3 = "DELETE FROM ONLINETICKET WHERE ticketID=".$row['ticketID'];
        $result3 = $conn->query($query3);
                    header("Location: home.php?success=You deleted your last reservation successfully");
                    exit();
    }
    else{
        header("Location: home.php?error=You can not delete expired reservations!!");
        exit();
    }
}
else{
    header("Location: home.php?error=No reservations found");
    exit();
}
    
?>