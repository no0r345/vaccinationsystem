<?php
include ("connection.php");
    session_start();
    if(!isset($_SESSION['admin_session'])){
        echo 
        "<script>window.location.href='login.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/index.css">
</head>

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
                    $roww = mysqli_fetch_assoc($result);
                    ?>
                    <a href='profile.php'><img src="<?php echo $roww['image']; ?>" alt=""></a>
                </div>
            </div>
            <!-- ======================= Cards ================== -->
            <?php
                include("cards.php");
            ?>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>