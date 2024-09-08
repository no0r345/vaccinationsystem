<?php
    include("../Admin/connection.php");
?>
<div class="cardBox">
    <div class="card">
        <div>
            <?php
                $query = "SELECT * FROM tbl_appointment WHERE h_id=$_SESSION[hospital_session]";
                $result = mysqli_query($conn,$query);
                $appointment_count = mysqli_num_rows($result);
            ?>
            <div class="numbers"><?php echo $appointment_count;?></div>
            <div class="cardName">Appointments</div>
        </div>
    </div>
    <div class="card">
        <div>
            <?php
                $query = "SELECT * FROM tbl_test WHERE h_id=$_SESSION[hospital_session]";
                $result = mysqli_query($conn,$query);
                $test_count = mysqli_num_rows($result);
            ?>
            <div class="numbers"><?php echo $test_count;?></div>
            <div class="cardName">Vaccine Test</div>
        </div>
    </div>
</div>