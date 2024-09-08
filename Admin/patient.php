<?php
    include("connection.php");
    session_start();
    if(!isset($_SESSION['admin_session']))
    {
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
        margin-top: 20px;
        border: 1px solid #999;
        text-align: center;
        border-collapse: collapse;
        padding: 10px;
    }
    .mainContent table a
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
                    $query = "SELECT * FROM tbl_admin WHERE id = {$_SESSION['admin_session']};";
                    $result = mysqli_query($conn,$query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <a href='profile.php'><img src="<?php echo $row['image']; ?>" alt=""></a>
                </div>
            </div>
            <!-- ======================= Cards ================== -->
            <div class="mainContent">
                <h2 class="title">List of Patients</h2>

                <a href="add_new_patient.php" class="btn">Create New Patient</a>
            

                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT tbl_patient.*,tbl_city.name as 'cname' FROM tbl_patient INNER JOIN tbl_city ON tbl_patient.cid=tbl_city.id";
                            $result = mysqli_query($conn,$query);
                            foreach($result as $row)
                            {
                                echo 
                                "<tr>
                                    <td>$row[id]</td>
                                    <td>$row[name]</td>
                                    <td>$row[contact]</td>
                                    <td>$row[cname]</td>
                                    <td>
                                    <a href='edit_patient.php?id=$row[id]'>Edit</a>&nbsp;
                                    <a href='view_patient.php?id=$row[id]'>View</a>&nbsp";
                                    if($row['status']=="deactivate"){
                                        echo "<a href='activate_patient.php?id=$row[id]' class='btnactivate'>Activate</a>";
                                     }else{
                                        echo "<a href='deactivate_patient.php?id=$row[id]' class='btndeactivate'>Deactivate</a>";
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