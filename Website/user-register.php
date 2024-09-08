<?php 
// Include the database connection file
include("../Admin/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
    <!-- Include Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <!-- Include Owl Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- Include Font Awesome CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Include Custom Styles -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- Include Responsive Styles -->
    <link href="assets/css/responsive.css" rel="stylesheet" />
    <!-- Include Form Styling -->
    <link rel="stylesheet" href="assets/css/formstyling.css">
</head>
<style>
    body
    {
        width: 100%;
        height: 100vh;
        background: url("assets/imgs/hero-bg.png");
        background-size: 100% 90%;
        background-position: 0% 0% 150%;
        background-repeat: no-repeat;
    }
    .text
    {
        padding: 20px 0px;
        text-align: left;
        display: flex;
        justify-content: flex-start;
    }

</style>
<body>
    <section class="main">
        <div class="form">
            <h2>Patient Registration Form</h2>
            <form method="post" autocomplete="off">
                <input type="text" placeholder="Enter Your Name" name="name" required><br><br>
                <input type="email" placeholder="Enter Email Address" name="email" required><br><br>
                <input type="password" placeholder="Enter Password" name="password" required><br><br>
                <input type="submit" value="Signup" name="btnregister">
            </form>
            <div class="text">
                <a href="login.php">Already Register? Login</a>
            </div>
            <?php 
            // Check if the registration form is submitted
            if(isset($_POST['btnregister'])){
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                
                // Insert the user data into the database
                $query = "INSERT INTO tbl_patient(name,email,password) VALUES('$name','$email','$password')";
                $result = mysqli_query($conn,$query);
                
                // Check if the registration was successful
                if($result){
                    echo 
                    "<script>
                    alert('Registration Successful');
                    window.location.href='login.php';
                    </script>";
                }
            }
            ?>
        </div>
    </section>
</body>
</html>
