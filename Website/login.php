<?php 
// Include the database connection file
include("../Admin/connection.php");
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <!-- Owl carousel stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- Font Awesome stylesheet -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- Responsive styles -->
    <link href="assets/css/responsive.css" rel="stylesheet" />
    <!-- Form styling -->
    <link rel="stylesheet" href="assets/css/formstyling.css">
</head>

<style>
    body {
        width: 100%;
        height: 100vh;
        background: url("assets/imgs/hero-bg.png");
        background-size: 100% 90%;
        background-position: 0% 0% 150%;
        background-repeat: no-repeat;
    }

    .text {
        padding: 20px 0px;
        text-align: left;
        display: flex;
        justify-content: flex-start;
    }
</style>

<body>
    <section class="main">
        <div class="form">
            <h2>Patient Login</h2>
            <!-- Patient login form -->
            <form method="post" autocomplete="off">
                <!-- Input field for email -->
                <input type="email" placeholder="Enter Email Address" name="email" required><br><br>
                <!-- Input field for password -->
                <input type="password" placeholder="Enter Password" name="password" required><br><br>
                <!-- Submit button for login -->
                <input type="submit" value="Login" name="btnlogin">
            </form>
            <!-- Text link for user registration -->
            <div class="text">
                <a href="user-register.php">Don't Have an Account? Signup</a>
            </div>
            <?php
            // Check if the login button is clicked
            if (isset($_POST["btnlogin"])) {
                // Get user input for email and password
                $email = $_POST["email"];
                $password = $_POST["password"];
                // Query to check if the entered email and password match a patient record
                $query = "SELECT * FROM tbl_patient WHERE email = '$email' AND password = '$password'";
                // Execute the query
                $result = mysqli_query($conn, $query);
                // Check if a matching record is found
                if (mysqli_num_rows($result) > 0) {
                // Fetch the user details
                $row = mysqli_fetch_assoc($result);
                        if($row['status']=='activate')
                        {  
                            // Set session variables for patient session
                            $_SESSION['patient_session'] = $row['id'];
                            $_SESSION['patient_name'] = $row['name'];
                            echo
                            // Redirect to the index page 
                            "<script>
                                alert('Login Successful');
                                window.location.href='index.php';
                            </script>";  
                        }
                        else
                        {
                            echo 
                             // Display an alert for incorrect email or password
                            "<script>
                                alert('Your Account is not Activate Yet.');
                                window.location.href='index.php';
                            </script>";  
                        }
                        
                    }
                    else
                    {
                        echo 
                        "<script>
                            alert('Incorrect Email or Password');
                        </script>";
                    }
            }
        
            ?>
        </div>
    </section>
</body>

</html>
