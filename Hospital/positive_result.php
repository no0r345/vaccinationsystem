<?php
    include("../Admin/connection.php");
    $query = "UPDATE tbl_test SET result='Positive' WHERE id=$_GET[id]";
    mysqli_query($conn,$query);
    echo "<script>window.location.href='vaccine-test.php'</script>";
?>