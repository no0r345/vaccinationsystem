
<?php
include("connection.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_session'])) {
    echo "<script>window.location.href='login.php'</script>";
    exit(); // Stop further execution
}

// Validate and sanitize the hospital ID from the URL
$hospitalId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if the hospital ID is valid
if ($hospitalId <= 0) {
    // Handle invalid or missing hospital ID
    echo "Invalid or missing hospital ID.";
    exit(); // Stop further execution
}

// Fetch the hospital details from the database
$query = "SELECT * FROM tbl_hospital WHERE id=$hospitalId";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
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
        display: flex;
        justify-content: space-around;
    }
    .mainContent .leftSide{
        width: 45%;
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
    .mainContent .rightSide{
        width: 45%;
    }
    .mainContent .rightSide .image{
        width: 100%;
        height: 300px;
        border: 1px solid #178066;
        margin-top: 40px;
    }
    .mainContent .rightSide .image img{
        width: 100%;
        height: 100%;
        
    }
    
</style>


<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <?php include("navigation.php"); ?>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="user">
                    <?php
                    $query = "SELECT * FROM tbl_admin WHERE id = {$_SESSION['admin_session']};";
                    $result = mysqli_query($conn, $query);
                    $roww = mysqli_fetch_assoc($result);
                    ?>
                    <a href='profile.php'><img src="<?php echo $roww['image']; ?>" alt=""></a>
                </div>
            </div>
            <!-- ======================= Cards ================== -->
            <div class="mainContent">
                <div class="leftSide">
                    <h2>Edit / Update Hospital</h2>
                    <form method="post" enctype="multipart/form-data" autocomplete="off">
                        <input type="text" placeholder="Enter Hospital Name" name="name" value="<?php echo "$row[name]"; ?>"><br>
                        <input type="number" placeholder="Enter Hospital Number" name="phone" value="<?php echo "$row[contact]"; ?>"><br>
                        <select name="city">
                            <option hidden>Select Any City</option>
                            <?php
                            $query = "SELECT * FROM tbl_city";
                            $result = mysqli_query($conn, $query);
                            foreach ($result as $row1) {
                                echo "<option value='" . $row1['id'] . "' ";
                                if ($row['cid'] == $row1['id']) {
                                    echo "selected";
                                }
                                echo ">" . $row1['name'] . "</option>";
                            }
                            ?>
                        </select><br>
                        <input type="email" placeholder="Enter Hospital Email" name="email" value="<?php echo "$row[email]"; ?>"><br>
                        <input type="password" placeholder="Enter Hospital Password" name="password" value="<?php echo "$row[password]"; ?>"><br>
                        <input type="text" placeholder="Enter Hospital Address" name="address" value="<?php echo "$row[address]"; ?>"><br>
                        <input type="submit" value="Update Hospital" name="btnadd">
                    </form>

                    <?php
                    // Handle form submission
                    if (isset($_POST['btnadd'])) {
                        $name = mysqli_real_escape_string($conn, $_POST['name']);
                        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                        $city = mysqli_real_escape_string($conn, $_POST['city']);
                        $email = mysqli_real_escape_string($conn, $_POST['email']);
                        $password = mysqli_real_escape_string($conn, $_POST['password']);
                        $address = mysqli_real_escape_string($conn, $_POST['address']);

                        // Update hospital details in the database
                        $query = "UPDATE tbl_hospital SET name='$name',contact='$phone',cid='$city',email='$email',password='$password',address='$address' WHERE id=$hospitalId";

                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            echo "
                            <script>
                            alert('Hospital Updated Successfully');
                            window.location.href='hospital.php';
                            </script>";
                        }
                    }
                    ?>
                </div>

                <div class="rightSide">
                    <div class="image">
                        <img src="<?php echo $row['image'] ?>" alt="hospital image">
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="image">
                        <input type="submit" value="Upload Image" name="btnupload">
                    </form>

                    <?php
                    // Handle image upload
                    if (isset($_POST['btnupload'])) {
                        $imageName = mysqli_real_escape_string($conn, $_FILES['image']['name']);
                        $tmpName = $_FILES['image']['tmp_name'];
                        $path = "assets/imgs/hospital-images/$imageName";

                        move_uploaded_file($tmpName, $path);

                        // Update image path in the database
                        $query = "UPDATE tbl_hospital SET image='$path' WHERE id=$hospitalId";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            echo "
                            <script>
                            alert('Image Updated Successfully');
                            window.location.href='hospital.php';
                            </script>";
                        }
                    }
                    ?>
                </div>
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
