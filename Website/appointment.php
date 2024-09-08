<?php
// Include the database connection file
include("../Admin/connection.php");
// Start the session
session_start();
// Check if the patient session is not set
if (!isset($_SESSION['patient_session'])) {
    // Redirect to the login page
    echo "<script>window.location.href='login.php';</script>";
}

// Query to fetch patient details based on the session ID
$query = "SELECT * FROM tbl_patient WHERE id={$_SESSION['patient_session']}";
// Execute the query
$result = mysqli_query($conn, $query);
// Fetch the patient details into an associative array
$patient = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">

    <title>User Profile </title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- Fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!-- Owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- Font Awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- Responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />

</head>
<style>
    header {
        background-color: #178066;
    }

    .mainContent {
        display: flex;
        justify-content: space-between;
        padding: 50px;
    }

    .mainContent .leftSide {
        width: 45%;
    }

    .mainContent .leftSide input,
    .mainContent .leftSide select {
        width: 100%;
        padding: 10px;
        border: 1px solid lightgray;
        outline: none;
        background-color: #eee;
        border-radius: 8px;
        margin: 10px 0px;
    }

    .mainContent .leftSide input[type="submit"] {
        background-color: #178066;
        color: #fff;
        font-size: 20px;
    }

    .mainContent .rightSide {
        width: 50%;
    }

    .mainContent .rightSide .image {
        margin-bottom: 20px;
        height: 435px;
        width: 435px;
    }

    .mainContent .rightSide table {
        width: 100%;
        margin-top: 17px;
        text-align: center;
    }

    .mainContent .rightSide table,
    tr,
    th,
    td {
        border: 1px solid lightgray;
        padding: 8px;
    }

    .mainContent .rightSide table thead {
        background-color: #178066;
        color: #fff;
    }
</style>

<body>
    <?php
    // Include the header file
    include("header.php");
    ?>
    <div class="mainContent">
        <div class="leftSide">
            <h2>Book Appointment</h2>
            <form method="POST">
                <!-- Input field for patient ID (hidden from patient)-->
                <input type="hidden" value="<?php echo $patient['id']; ?>" name="pid" readonly>
                <!-- Input field for patient name -->
                <input type="text" value="<?php echo $patient['name']; ?>" readonly>
                <!-- Dropdown for hospital selection -->
                <select name="hid">
                    <option hidden>Select Any Hospital</option>
                    <?php
                    // Query to fetch hospitals with status 'activate'
                    $query = "SELECT * FROM tbl_hospital WHERE status ='activate'";
                    // Execute the query
                    $result = mysqli_query($conn, $query);
                    // Loop through results to display options
                    foreach ($result as $row) {
                        echo "<option value='$row[id]'>$row[name]</option>";
                    }
                    ?>
                </select>
                <!-- Date input field with minimum date set to the current date -->
                <input type="date" name="date" min="<?php echo date('Y-m-d'); ?>" required>
                <!-- Dropdown for time slot selection -->
                <select name="time">
                    <option hidden>Select Time Slot</option>
                    <option>9-11</option>
                    <option>11-1</option>
                    <option>3-5</option>
                    <option>6-8</option>
                </select>
                <!-- Dropdown for vaccine selection -->
                <select name="vid">
                    <option hidden>Select Any Vaccine</option>
                    <?php
                    // Query to fetch available vaccines
                    $query = "SELECT * FROM tbl_vaccine WHERE status ='available'";
                    // Execute the query
                    $result = mysqli_query($conn, $query);
                    // Loop through results to display options
                    foreach ($result as $row) {
                        echo "<option value='$row[id]'>$row[name]</option>";
                    }
                    ?>
                </select>
                <!-- Submit button -->
                <input type="submit" value="Book Appointment" name="btnbook">
            </form>
            <?php
            // Check if the form is submitted
            if (isset($_POST['btnbook'])) {
                // Get form data
                $pid = $_POST['pid'];
                $hid = $_POST['hid'];
                $date = $_POST['date'];
                $time = $_POST['time'];
                $vid = $_POST['vid'];

                // Check if any of the required fields is not selected or empty
                if ($hid == "Select Any Hospital" || empty($date) || $time == "Select Time Slot" || $vid == "Select Any Vaccine") {
                    // Display an alert and redirect to the appointment page
                    echo "<script>alert('Please fill in all the fields');</script>";
                    echo "<script>window.location.href='appointment.php'</script>";
                } else {
                    // Check for existing appointments with the same details
                    $query = "SELECT * FROM tbl_appointment WHERE h_id='$hid' AND date='$date' AND time = '$time' AND v_id='$vid' AND status='pending' AND p_id={$_SESSION['patient_session']}";
                    $existing_appointment = mysqli_query($conn, $query);

                    // If no existing appointments found, insert a new appointment
                    if (mysqli_num_rows($existing_appointment) == 0) {
                        $query = "INSERT INTO tbl_appointment(p_id,h_id,date,time,v_id)VALUES('$pid','$hid','$date','$time','$vid')";
                        $result = mysqli_query($conn, $query);
                        // Check if the appointment is booked successfully
                        if ($result) {
                            echo "<script>alert('Appointment Booked Successfully');</script>";
                            echo "<script>window.location.href='appointment.php'</script>";
                        }
                    } else {
                        // Display an alert if an appointment already exists
                        echo "<script>alert('Appointment Already Exists');</script>";
                    }
                }
            }
            ?>
        </div>
        <div class="rightSide">
            <!-- Table display the appointments details taken by the user -->
            <table>
                <thead>
                    <tr>
                        <th>Hospital Name</th>
                        <th>Vaccine Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query to fetch appointments for the logged-in patient
                    $query = "SELECT tbl_hospital.name as 'hname', tbl_vaccine.name as 'vname', tbl_appointment.* 
                  FROM tbl_appointment 
                  INNER JOIN tbl_hospital ON tbl_appointment.h_id = tbl_hospital.id 
                  INNER JOIN tbl_vaccine ON tbl_appointment.v_id = tbl_vaccine.id 
                  WHERE p_id = {$_SESSION['patient_session']}";

                    // Execute the query
                    $result = mysqli_query($conn, $query);
                    // Loop through results to display appointment details
                    foreach ($result as $row) {
                        echo
                        "<tr>
                        <td>" . htmlspecialchars($row['hname']) . "</td>
                        <td>" . htmlspecialchars($row['vname']) . "</td>
                        <td>" . htmlspecialchars($row['date']) . "</td>
                        <td>" . htmlspecialchars($row['time']) . "</td>
                        <td>" . htmlspecialchars($row['status']) . "</td>
                    </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
