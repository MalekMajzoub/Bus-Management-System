<?php
session_start(); 
include "db_conn.php";
?>
<html>
     <head>
          <title>
          Reservation Page
          </title>

          <script type="text/javascript">
          function timedMsg(){
               var t=setTimeout("document.getElementById('myMsg').style.display='none';",4000);}
          </script>

          <script src="jquery-3.6.0.min.js"></script>
          <link rel="stylesheet" type="text/css" href="style.css">
     </head>
     <body>

          <form action="reserve-check.php" method="POST">
               <h2>RESERVE YOUR SEAT</h2>

               <?php if (isset($_GET['error'])) { ?>
     		     <p id="myMsg" class="error"><?php echo $_GET['error']; ?></p>
     	     <?php } ?>

               <?php if (isset($_GET['success'])) { ?>
                    <p id="myMsg" class="success"><?php echo $_GET['success']; ?></p>
               <?php } ?>

               <script language="JavaScript" type="text/javascript">timedMsg()</script>

               <div>
               <?php
               $query = "SELECT DISTINCT TLStart FROM TRAVELLINE Order by TLStart";
               $result = $conn->query($query);
               ?>
               <label> Pickup Location </label>
               <select name="TLStart" id="TLStart" onchange="fetchEnd(this.value)"  required>
               <option selected disabled >Select Start location</option>
               <?php
               if ($result->num_rows > 0 ) {
                    while ($row = $result->fetch_assoc()) {
                    echo '<option value='.$row['TLStart'].'>'.$row['TLStart'].'</option>';
                    }
               }
               ?> 
               </select>
               </div>

               
               <div>   
               <label> Drop-Off Location </label>
               <select name="stopLocation" id="stopLocation" onchange="fetchTime(this.value)" required>
               <option>Select Drop-Off Location</option>
               </select>
               </div>

               <div>
               <label> Reservation Time </label>
               <select name="ResTime" id="ResTime" required>
               <option selected disabled>Select Trip Time</option>
               </select>
               </div>
               
               <div>
               <label> Reservation Day </label>
               <input min="<?php echo date("Y-m-d");?>" type="date" name="ResDay" id="ResDay" placeholder="Reservation Day" required>
               </input>
               </div>

               <button type="Submit">Reserve</button>
          
               <a href='tickets.php' class="ca">Check Reservation History</a>

               <a href='delete-res.php' class="ca">Delete Last Reservation</a>

               <button onclick="location.href = 'logout.php';">Sign out</button>
          </form>
          <script type="text/javascript">
               function fetchEnd(TLStart){
               $('#stopLocation').html('');
               $.ajax({       
                    type:'post',
                    url: 'getData.php',
                    data : { TLStart : TLStart},
                    success : function(data){
                    $('#stopLocation').html(data);
                    }

               })
               }

               function fetchTime(TLEnd){
               $('#ResTime').html('');
               $.ajax({
                    type:'post',
                    url: 'getData.php',
                    data : { TLEnd : TLEnd},
                    success : function(data){
                    $('#ResTime').html(data);
                    }

               })
               }
          </script>
     </body>
</html>