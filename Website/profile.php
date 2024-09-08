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
        align-items: center;
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

    .mainContent .rightSide .image img {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }

    .mainContent .rightSide input[type="file"] {
        margin: 10px 0px;
    }

    .mainContent .rightSide input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: 1px solid lightgray;
        outline: none;
        background-color: #eee;
        border-radius: 8px;
        margin: 10px 0px;
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
            <h2>My Profile</h2>
            <form method="post">
                <!-- Input field for patient name -->
                <input type="text" placeholder="Enter Your Name" name="name" value="<?php echo $patient['name']; ?>"><br>
                <!-- Input field for phone number -->
                <input type="text" placeholder="Enter Phone Number" name="phone" value="<?php echo $patient['contact']; ?>"><br>
                <!-- Input field for email address -->
                <input type="text" placeholder="Enter Email Address" name="email" value="<?php echo $patient['email']; ?>"><br>
                <!-- Input field for password -->
                <input type="text" placeholder="Enter Your Password" name="password" value="<?php echo $patient['password']; ?>"><br>
                <!-- Dropdown for city selection -->
                <select name="city">
                    <option hidden>Select Any City</option>
                    <?php
                    // Query to fetch city options
                    $query = "SELECT * FROM tbl_city";
                    // Execute the query
                    $result = mysqli_query($conn, $query);
                    // Loop through results to display city options
                    foreach ($result as $row) {
                        echo "<option value='$row[id]'>$row[name]</option>";
                    }
                    ?>
                </select><br>
                <!-- Dropdown for gender selection -->
                <select name="gender">
                    <option hidden>Select Any Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select><br>
                <!-- Input field for address -->
                <input type="text" placeholder="Enter Your Address" name="address" value="<?php echo $patient['address']; ?>"><br>
                <!-- Submit button for updating profile -->
                <input type="submit" value="Update Profile" name="btnupdate">
            </form>
            <?php
            // Check if the update profile button is clicked
            if (isset($_POST['btnupdate'])) {
                // Get form values
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $city = $_POST['city'];
                $gender = $_POST['gender'];
                $address = $_POST['address'];
                // Query to update patient profile
                $query = "UPDATE tbl_patient SET name='$name', contact='$phone',email='$email',password='$password',cid='$city',address='$address',gender='$gender' WHERE id={$_SESSION['patient_session']}";
                // Execute the query
                $result = mysqli_query($conn, $query);
                // Check if the profile is updated successfully
                if ($result) {
                    echo
                    "<script>
                    alert('Profile Updated');
                    window.location.href='profile.php';
                    </script>";
                }
            }
            ?>
        </div>
        <div class="rightSide">
            <div class="image">
                <!-- Display patient image -->
                <img src="<?php echo $patient['image']; ?>" alt="this is a user image">
            </div>
            <form method="post" enctype="multipart/form-data">
                <!-- Input field for uploading image -->
                <input type="file" name="image" required><br>
                <!-- Submit button for uploading image -->
                <input type="submit" value="Upload Image" name="btnupload">
            </form>
            <?php
            // Check if the upload image button is clicked
            if (isset($_POST['btnupload'])) {
                // Get image details
                $imageName = $_FILES['image']['name'];
                $tmpName = $_FILES['image']['tmp_name'];
                $path = "assets/imgs/patient-images/$imageName";
                // Move uploaded image to the destination path
                move_uploaded_file($tmpName, $path);
                // Query to update patient image path
                $query = "UPDATE tbl_patient SET image = '$path' WHERE id={$_SESSION['patient_session']}";
                // Execute the query
                $result = mysqli_query($conn, $query);
                // Check if the image is updated successfully
                if ($result) {
                    echo
                    "<script>
                    alert('Image Updated');
                    window.location.href='profile.php';
                    </script>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>
