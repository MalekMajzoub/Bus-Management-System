<?php
session_start(); 
include "db_conn.php";
?>
<html>
     <head>
          <title>
          Your Tickets
          </title>
          <link rel="stylesheet" href="style2.css">
     </head>
     <body>
            <?php
                $sql = "SELECT passengerID, ticketDOP, ticketPickUPLoc, ticketDropOffLoc, ticketPrice, resTimeFrom, resTimeTo, busID, driverFN, driverLN
                    FROM ONLINETICKET NATURAL JOIN SEAT NATURAL JOIN BUS NATURAL JOIN DRIVES NATURAL JOIN DRIVER
                         ORDER BY ticketDOP";
                $result = mysqli_query($conn, $sql);
                ?>
                <table width='90%' border=2>
                <tr>
                    <td>Passenger ID</td>
                    <td>Date of purchase</td>
                    <td>Pick up Location </td>
                    <td>Dropoff Location </td>
                    <td>Ticket Price </td>
                    <td>Bus take off time </td>
                    <td>ETA </td>
                    <td>Bus number </td>
                    <td>Driver name </td>

                
                </tr>
            <?php 
     
        while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
            echo "<td>".$res['passengerID']."</td>";
            echo "<td>".$res['ticketDOP']."</td>";
            echo "<td>".$res['ticketPickUPLoc']."</td>";
            echo "<td>".$res['ticketDropOffLoc']."</td>"; 
            echo "<td>".$res['ticketPrice']." L.L</td>"; 
            echo "<td>".$res['resTimeFrom']."</td>"; 
            echo "<td>".$res['resTimeTo']."</td>"; 
            echo "<td>".$res['busID']."</td>"; 
            echo "<td>".$res['driverFN']." ".$res['driverLN']."</td>"; 
            
                    
        }
        ?>
        </table>
    </body>
</html>