<?php
// Include the connection file for database connectivity
include("connection.php");

// Start the session
session_start();

// Check if the admin session is not set, redirect to the login page
if (!isset($_SESSION['admin_session'])) {
    echo "<script>window.location.href='login.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination System</title>
    <!-- ======= Styles ======= -->
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<style>
    .mainContent {
        padding: 30px;
    }

    .mainContent .title {
        font-size: 35px;
    }

    .mainContent table {
        width: 100%;
    }

    .mainContent table,
    td,
    th {
        margin-top: 20px;
        border: 1px solid #999;
        text-align: center;
        border-collapse: collapse;
        padding: 10px;
    }

    .mainContent table a {
        padding: 7px 10px;
        background-color: #178066;
        text-decoration: none;
        border-radius: 8px;
        color: #fff;
    }

    .mainContent .btndeactivate {
        background-color: red;
    }

    .mainContent .btnactivate {
        background-color: yellowgreen;
        color: #000;
    }

    .mainContent .btn {
        display: inline-block;
        margin-top: 15px;
        padding: 7px 10px;
        background-color: #178066;
        text-decoration: none;
        border-radius: 8px;
        color: #fff;
    }
</style>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <?php
        // Include the navigation file
        include("navigation.php");
        ?>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="user">
                    <?php
                    // Fetch admin details based on the session ID
                    $query = "SELECT * FROM tbl_admin WHERE id = " . (int)$_SESSION['admin_session'];
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <!-- Display the admin profile image -->
                    <a href='profile.php'><img src="<?php echo htmlspecialchars($row['image']); ?>" alt=""></a>
                </div>
            </div>
            <!-- ======================= Cards ================== -->
            <div class="mainContent">
                <h2 class="title">List of Feedback</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Patient Name</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch feedback data and join with patient data
                        $query = "SELECT tbl_feedback.*, tbl_patient.name as 'pname' FROM tbl_feedback INNER JOIN tbl_patient ON tbl_feedback.p_id = tbl_patient.id";
                        $result = mysqli_query($conn, $query);
                        foreach ($result as $row) {
                            echo
                            "<tr>
                                <td>" . htmlspecialchars($row['id']) . "</td>
                                <td>" . htmlspecialchars($row['pname']) . "</td>
                                <td>" . htmlspecialchars($row['message']) . "</td>
                                <td>" . htmlspecialchars($row['status']) . "</td>
                                <td>";
                            // Check feedback status and provide appropriate action link
                            if ($row['status'] == "hide") {
                                echo "<a href='show_feedback.php?id=" . htmlspecialchars($row['id']) . "' class='btnactivate'>Show</a>";
                            } else {
                                echo "<a href='hide_feedback.php?id=" . htmlspecialchars($row['id']) . "' class='btndeactivate'>Hide</a>";
                            }
                            "</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
