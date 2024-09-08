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
        padding: 30px 80px;
    }
    .mainContent form input,
    .mainContent form select
    {
        width: 100%;
        border: none;
        outline: none;
        padding: 15px 20px;
        border-radius: 6px;
        background-color: #eee;
        margin: 12px 0px;
        font-size: 16px;
    }
    .mainContent form input[type="submit"]
    {
        background-color: #178066;
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
                <h2>Register a New Patient</h2>
                <form method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="text" placeholder="Enter Patient Name" name="name"><br>
                    <input type="number" placeholder="Enter Patient Number" name="phone"><br>
                    <select name="city">
                        <option hidden>Select Any City</option>
                        <?php
                            $query = "SELECT * FROM tbl_city";
                            $result = mysqli_query($conn,$query);
                            foreach($result as $row){
                              echo "<option value='$row[id]'>$row[name]</option>";
                            }

                         ?>
                    </select><br>  
                    <input type="email" placeholder="Enter Patient Email" name="email"><br>
                    <input type="password" placeholder="Enter Patient Password" name="password"><br>
                    <input type="text" placeholder="Enter Patient Address" name="address"><br>
                    <select name="gender">
                        <option hidden>Select Any Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <select name="status">
                        <option hidden>Select Any Status</option>
                        <option value="activate">Activate</option>
                        <option value="deactivate">Deactive</option>
                    </select><br>
                    <input type="file" name="image"><br>
                    <input type="submit" value="Add New Patient" name="btnadd">
                </form>
                <?php
                if(isset($_POST['btnadd'])){
                    $name = $_POST['name'];
                    $phone = $_POST['phone'];
                    $city = $_POST['city'];
                    $email =trim($_POST['email']);
                    $password = $_POST['password'];
                    $address = $_POST['address'];
                    $gender = $_POST['gender'];
                    $status = $_POST['status'];
                    $imageName = $_FILES['image']['name'];
                    $tmpName = $_FILES['image']['tmp_name'];
                    $path = "assets/imgs/patient-images/$imageName";
                    move_uploaded_file($tmpName,$path);
                    $query = "INSERT INTO tbl_patient (name, contact, cid, email, password, address, gender, status, image)
                    VALUES ('$name', '$phone', '$city', '$email', '$password', '$address','$gender','$status', '$path')";          

                    $result = mysqli_query($conn,$query);
                    if($result){
                        echo "
                        <script>
                        alert('New patient has been Added');
                        window.location.href='patient.php';
                        </script>";
                    }

                }
                ?>
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