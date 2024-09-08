<?php
    include("connection.php");
?>
<div class="cardBox">
    <div class="card">
        <div>
            <?php
                $query = "SELECT * FROM tbl_patient";
                $result = mysqli_query($conn,$query);
                $patient_count = mysqli_num_rows($result);
            ?>
            <div class="numbers"><?php echo $patient_count;?></div>
            <div class="cardName">Patient</div>
        </div>
    </div>
    <div class="card">
        <div>
            <?php
                $query = "SELECT * FROM tbl_hospital";
                $result = mysqli_query($conn,$query);
                $hospital_count = mysqli_num_rows($result);
            ?>
            <div class="numbers"><?php echo $hospital_count;?></div>
            <div class="cardName">Hospital</div>
        </div>
    </div>
    <div class="card">
        <div>
            <?php
                $query = "SELECT * FROM tbl_appointment";
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
                $query = "SELECT * FROM tbl_test";
                $result = mysqli_query($conn,$query);
                $test_count = mysqli_num_rows($result);
            ?>
            <div class="numbers"><?php echo $test_count;?></div>
            <div class="cardName">Vaccine Test</div>
        </div>
    </div>
</div>