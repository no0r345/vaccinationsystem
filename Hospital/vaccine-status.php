<?php
    include("../Admin/connection.php");
    session_start();
    if(!isset($_SESSION['hospital_session']))
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
                    $query = "SELECT * FROM tbl_hospital WHERE id = {$_SESSION['hospital_session']};";
                    $result = mysqli_query($conn,$query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <a href='profile.php'><img src="<?php echo $row['image']; ?>" alt=""></a>
                </div>
            </div>
            <!-- ======================= Cards ================== -->
            
             <!-- =========== For vaccine status =========  -->
             <div class="mainContent">
                <h2 class="title">Vaccine Status</h2>

                <table>
                    <thead>
                        <tr>
                            <th>Id</th> 
                            <th>Vaccine</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM tbl_vaccine";
                            $result = mysqli_query($conn,$query);
                            foreach($result as $row)
                            {
                                echo 
                                "<tr>
                                    <td>$row[id]</td>
                                    <td>$row[name]</td>
                                    <td>$row[status]</td>
                                    <td>
                                        <a href='available_vaccine.php?id=$row[id]' class='btnactivate'>Available</a>
                                        <a href='unavailable_vaccine.php?id=$row[id]' class='btndeactivate'>Unavailable</a>
                                    </td>
                                    
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