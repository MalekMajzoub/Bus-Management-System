<?php 
session_start();
include "db_conn.php";
    $TLSTART = $_POST['TLStart'];
	$STOPLOCATION = $_POST['stopLocation'];
    $RESTIMEFROM = date("Y-m-d"). ' ' .$_POST['ResTime'];
    $RESTIMEFROM2 = $_POST['ResDay']. ' ' .$_POST['ResTime'];
    $RESTIMETO = date("Y-m-d H:i:s",strtotime('+2 hour',strtotime($RESTIMEFROM2)));
    $PASSID = (int)$_SESSION['id'];
    $sql = "SELECT travelLineID FROM STOP NATURAL JOIN TRAVELLINESTOP NATURAL JOIN TRAVELLINE
                WHERE TLSTART='$TLSTART' AND stopLocation='$STOPLOCATION' AND TimeFrom='$RESTIMEFROM2'";
                 $result = mysqli_query($conn, $sql);
                 if ($result->num_rows > 0 ) {
                    while ($row = $result->fetch_assoc()) {
                    $TLID = $row['travelLineID'];
                    }
               }
    
    $sql2 = "SELECT seatID FROM SEAT
                WHERE busID = (SELECT busID FROM BUSTRAVELLINE WHERE travelLineID=$TLID) 
                AND status=0 LIMIT 1";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2->num_rows > 0 ) {
                    while ($row = $result2->fetch_assoc()) {
                    $SID = $row['seatID'];

                    $modifyStat = "UPDATE SEAT
                                    SET status=1 
                                    WHERE seatID=$SID";
                    $modifyResult = mysqli_query($conn, $modifyStat);

                    $sql3 = "INSERT INTO ONLINETICKET(ticketDOP, ticketPickUPLoc, ticketDropOffLoc, ticketPrice ,resTimeFrom, resTimeTo, passengerID, seatID)
                        VALUES(CURRENT_TIMESTAMP(), '$TLSTART', '$STOPLOCATION', 15000 , '$RESTIMEFROM2' , '$RESTIMETO',$PASSID,$SID)";
                    $result3 = mysqli_query($conn, $sql3);
                    if ($result3) {
           	            header("Location: home.php?success=You reserved your seat successfully");
	                    exit();
                    }
                    }
                }else{
                    header("Location: home.php?error=Sorry for the inconvenience the bus is full!");
                    exit();
                }
?>