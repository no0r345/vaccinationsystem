<?php
    include("connection.php");
    $query = "UPDATE tbl_vaccine SET status='Unavailable' WHERE id=$_GET[id]";
    mysqli_query($conn,$query);
    echo "<script>window.location.href='appointment.php'</script>";
?>