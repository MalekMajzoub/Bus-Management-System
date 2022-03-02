<?php  
include "db_conn.php";
?>
<html>
    <head>
          <title>
            Admin 
          </title>
          <link rel="stylesheet" href="style2.css">
    </head>
    <body>
        <form action="admin-check.php" method="POST">

        <?php if (isset($_GET['success'])) { ?>
                    <p id="myMsg" class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

        <script language="JavaScript" type="text/javascript">timedMsg()</script>

        <button type="Submit" name="seats">Clear Seats</button>

        <button type="Submit" name="tickets">Show All Tickets</button>

        </form>
    </body>
</html>






