<?php
    include("connection.php");
    $query = "UPDATE tbl_patient SET status='deactivate' WHERE id=$_GET[id]";
    mysqli_query($conn,$query);
    echo "<script>window.location.href='patient.php'</script>";
?>