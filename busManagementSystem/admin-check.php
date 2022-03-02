<?php
include "db_conn.php";
if(isset($_POST['seats'])){

    $query = "UPDATE SEAT SET status=0";
    $result = $conn->query($query);
    header("Location: admin.php?success=All seats have been cleared");
        exit();
}elseif(isset($_POST['tickets'])){

    header("Location: admin-print.php?success=All seats have been cleared");
    exit();

}

?>