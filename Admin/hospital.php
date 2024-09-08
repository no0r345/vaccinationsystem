<?php
// Include the connection file for database connectivity
include("connection.php");

// Start the session and check if the admin is logged in
session_start();

// Validate and sanitize the session variable to prevent injection
$adminSession = isset($_SESSION['admin_session']) ? intval($_SESSION['admin_session']) : 0;

if ($adminSession <= 0) {
    // Redirect to the login page if the session is not valid
    header("Location: login.php");
    exit(); // Ensure that the script stops execution after redirecting
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination System</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<style>
    .mainContent
    {
        padding: 30px;
    }
    .mainContent .title
    {
        font-size: 35px;
    }
    .mainContent table
    {
        width: 100%;
    }
    .mainContent table,td,th 
    {
        margin-top: 25px;
        border: 1px solid #999;
        text-align: center;
        border-collapse: collapse;
        padding: 10px;
    }
    .mainContent h2{
        margin-bottom: 17px;
    }
    .mainContent a
    {
        padding: 7px 10px;
        background-color: #178066;
        text-decoration: none;
        border-radius: 8px;
        color: #fff; 
    }
    .mainContent .btndeactivate
    {
        background-color: red;
    }
    .mainContent .btnactivate
    {
        background-color: yellowgreen;
        color: #000;
    }
    .mainContent .btn
    {
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
                    // Fetch admin details using the sanitized session ID
                    $query = "SELECT * FROM tbl_admin WHERE id = $adminSession;";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <!-- Display admin profile image -->
                    <a href='profile.php'><img src="<?php echo htmlspecialchars($row['image']); ?>" alt=""></a>
                </div>
            </div>
            <!-- ======================= Cards ================== -->
            <div class="mainContent">
                <h2 class="title">List of Hospitals</h2>
                <a href="add_new_hospital.php">Create New Hospital</a>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch hospitals data
                        $query = "SELECT * FROM tbl_hospital";
                        $result = mysqli_query($conn, $query);

                        // Loop through the results and display hospital details
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Sanitize output data
                            $id = htmlspecialchars($row['id']);
                            $name = htmlspecialchars($row['name']);
                            $contact = htmlspecialchars($row['contact']);
                            $status = htmlspecialchars($row['status']);

                            echo
                                "<tr>
                                 <td>{$id}</td>
                                 <td>{$name}</td>
                                 <td>{$contact}</td>
                                 <td>{$status}</td>
                                 <td>
                                 <a href='edit_hospital.php?id={$id}'>Edit</a>&nbsp;
                                 <a href='view_hospital.php?id={$id}'>View</a>&nbsp";

                            // Check hospital status for activation/deactivation links
                            if ($status == "deactivate") {
                                echo "<a href='activate_hospital.php?id={$id}' class='btnactivate'>Activate</a>";
                            } else {
                                echo "<a href='deactivate_hospital.php?id={$id}' class='btndeactivate'>Deactivate</a>";
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