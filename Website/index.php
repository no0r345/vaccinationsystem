<?php
  include("../Admin/connection.php");
  session_start();
  if(isset($_SESSION['patient_session'])){
  $fetch_patient = "SELECT * FROM tbl_patient WHERE id={$_SESSION['patient_session']}";
  $active_patient = mysqli_fetch_assoc(mysqli_query($conn,$fetch_patient));}
  else{
    $fetch_patient = "SELECT * FROM tbl_patient";
  $active_patient = mysqli_fetch_assoc(mysqli_query($conn,$fetch_patient));
  }
  
?>
<!DOCTYPE html>
<html>
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

  <title> Child Vaccination System </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>
<style>
  .hideContact
  {
    display: none;
  }
</style>
<body>

  <div class="hero_area">

    <div class="hero_bg_box">
      <img src="images/hero-bg.png" alt="">
    </div>

    <!-- header section starts -->
     <?php
    include("header.php");
     ?>
    
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>
                    Guardians of Childhood Immunity
                    </h1>
                    <p>
                    "Tiny Shots, Big Protection".We tirelessly bridge the gap, connecting children to a fortified shield of vaccinations. With unwavering care, precision, and medical excellence, we ensure a robust foundation for lifelong immunity.
                    </p>
                    <div class="btn-box">
                      <a href="appointment.php" class="btn1">
                        Appointment
                      </a>
                      <a href="vaccine-test.php" class="btn1">
                        Vaccine Test
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- end slider section -->
  </div>


  <!-- department section -->

  <section class="department_section layout_padding">
    <div class="department_container">
      <div class="container ">
        <div class="heading_container heading_center">
          <h2>
            Our Departments
          </h2>
          <p>
            Asperiores sunt consectetur impedit nulla molestiae delectus repellat laborum dolores doloremque accusantium
          </p>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="box ">
              <div class="img-box">
                <img src="images/s1.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Cardiology
                </h5>
                <p>
                  fact that a reader will be distracted by the readable page when looking at its layout.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="box ">
              <div class="img-box">
                <img src="images/s2.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Diagnosis
                </h5>
                <p>
                  fact that a reader will be distracted by the readable page when looking at its layout.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="box ">
              <div class="img-box">
                <img src="images/s3.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Surgery
                </h5>
                <p>
                  fact that a reader will be distracted by the readable page when looking at its layout.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="box ">
              <div class="img-box">
                <img src="images/s4.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  First Aid
                </h5>
                <p>
                  fact that a reader will be distracted by the readable page when looking at its layout.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="btn-box">
          <a href="">
            View All
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- end department section -->

  <!-- about section -->

  <section id="about" class="about_section layout_margin-bottom">
    <div class="container  ">
      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="images/about-img.jpg" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                About <span>Us</span>
              </h2>
            </div>
            <p>
            Welcome to Child Vaccination System, where we prioritize the health and well-being of your little ones. Our mission is to make immunization a seamless and positive experience, ensuring every child receives the necessary vaccines for a healthy and happy future. Trust us to safeguard your child's health journey.
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- hospital section -->

  <section id="hospital" class="doctor_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Hospitals
        </h2>
        <p class="col-md-10 mx-auto px-0">
        Our hospitals are dedicated to providing exceptional healthcare services, combining cutting-edge technology with compassionate care.Experience top-notch healthcare at our hospitals.
        </p>
      </div>
      <div class="row">
      <?php 
          $query = "SELECT tbl_hospital.*,tbl_city.name as 'cname' FROM tbl_hospital INNER JOIN tbl_city ON tbl_hospital.cid=tbl_city.id WHERE tbl_hospital.status='activate'";

          $result = mysqli_query($conn,$query);
          foreach($result as $row)
          {
            echo '<div class="col-sm-6 col-lg-4 mx-auto">
            <div class="box">
              <div class="img-box">
              <img src=../Admin/'.$row['image'].' alt="" style="height:300px">
              </div>
              <div class="detail-box">
                <div class="social_box">
                  <a href="">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-youtube" aria-hidden="true"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                </div>
                <h5>'.$row['name'].'</h5>
                <h6 class="">'.$row['cname'].'</h6>
              </div>
            </div>
          </div>';
          }
        ?>
       
      </div>
      <div class="btn-box">
        <a href='#'>View All</a>
      </div>
    </div>
  </section><br><br>

  <!-- end doctor section -->

  <!-- contact section -->
  <section id="contact" class='contact_section layout_padding <?php if(!isset($_SESSION['patient_session'])){ echo "hideContact";} ?>'>
    <div class="container">
      <div class="heading_container">
        <h2>
          Get In Touch
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container contact-form">
            <form method="post">
              <div class="form-row">
                <div class="col-lg-6">
                  <div>
                    <input type="hidden" value="<?php echo $active_patient['id'];?>" name="pid">
                    <input type="text" placeholder="Your Name" value="<?php echo $active_patient['name'];?>"  readonly/>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div>
                    <input type="text" placeholder="Phone Number" value="<?php echo $active_patient['contact'];?>" readonly/>
                  </div>
                </div>
              </div>
              <div>
                <input type="email" placeholder="Email" value="<?php echo $active_patient['email'];?>" readonly/>
              </div>
              <div>
                <input type="text" class="message-box" placeholder="Message" name="message" required/>
              </div>
              <div class="btn_box">
                <button type="submit" name="btnsend">Send</button>
              </div>
            </form>
            <?php
               if (isset($_POST['btnsend'])) {
               $pid = $_POST['pid'];
               $message = $_POST['message'];

                // Use prepared statement to prevent SQL injection
                $stmt = mysqli_prepare($conn, "INSERT INTO tbl_feedback (p_id, message) VALUES (?, ?)");

                // Bind parameters and execute the statement
                 mysqli_stmt_bind_param($stmt, 'is', $pid, $message);
                $result = mysqli_stmt_execute($stmt);
 
               // Check if the query was successful
                if ($result) {
              echo "<script>
                 alert('Feedback Sent Successfully');
                 window.location.href='index.php';
                 </script>";}
                 else {
               // Handle the error appropriately, e.g., log it or display an error message
               echo "Error: " . mysqli_error($conn);
              }

               // Close the prepared statement
                 mysqli_stmt_close($stmt);
             }
              ?>
          </div>  
        </div>

        <div class="col-md-6">
          <div class="map_container">
            <div class="map">
              <div id="googleMap"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->

  <!-- client section -->

  <section id="testimonial" class="client_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center ">
        <h2>
          Testimonial
        </h2>
      </div>
      <div id="carouselExample2Controls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
        <?php 

$result = mysqli_query($conn,"SELECT tbl_feedback.*, tbl_patient.name as 'pname',tbl_patient.image FROM tbl_feedback INNER JOIN tbl_patient ON tbl_feedback.p_id = tbl_patient.id WHERE tbl_feedback.status='show'");

$firstFeedback = true;

foreach($result as $feedback)
{
  $activeClass = $firstFeedback?'active':'';
  echo '<div class="carousel-item '.$activeClass.'">
  <div class="row">
    <div class="col-md-11 col-lg-10 mx-auto">
      <div class="box">
        <div class="img-box">
          <img src="'.$feedback['image'].'" alt="" />
        </div>
        <div class="detail-box">
          <div class="name">
            <h6>'.$feedback['pname'].'</h6>
          </div>
          <p>'.$feedback['message'].'</p>
          <i class="fa fa-quote-left" aria-hidden="true"></i>
        </div>
      </div>
    </div>
  </div>
</div>';
$firstFeedback=false;
}
?>
        </div>
        <div class="carousel_btn-container">
          <a class="carousel-control-prev" href="#carouselExample2Controls" role="button" data-slide="prev">
            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExample2Controls" role="button" data-slide="next">
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- end client section -->

  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3 footer_col">
          <div class="footer_contact">
            <h4>
              Reach at..
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Location
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +01 1234567890
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  demo@gmail.com
                </span>
              </a>
            </div>
          </div>
          <div class="footer_social">
            <a href="">
              <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer_col">
          <div class="footer_detail">
            <h4>
              About
            </h4>
            <p>
              Beatae provident nobis mollitia magnam voluptatum, unde dicta facilis minima veniam corporis laudantium alias tenetur eveniet illum reprehenderit fugit a delectus officiis blanditiis ea.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-2 mx-auto footer_col">
          <div class="footer_link_box">
            <h4>
              Links
            </h4>
            <div class="footer_links">
              <a class="active" href="index.html">
                Home
              </a>
              <a class="" href="about.html">
                About
              </a>
              <a class="" href="departments.html">
                Departments
              </a>
              <a class="" href="doctors.html">
                Doctors
              </a>
              <a class="" href="contact.html">
                Contact Us
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer_col ">
          <h4>
            Newsletter
          </h4>
          <form action="#">
            <input type="email" placeholder="Enter email" />
            <button type="submit">
              Subscribe
            </button>
          </form>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a>
        </p>
      </div>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- custom js -->
  <script type="text/javascript" src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('a[href^="#"]');

        links.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>


</html>