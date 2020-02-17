<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Turning Point 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">


    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="container text-center">
    	<div class="row">
    		<div class="col-sm-6 col-sm-offset-3" style="margin: 0 auto;">
    			<div class="thanks-wrap">

    				<div class="checkmark">
    					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 161.2 161.2">
    						<circle class="path" fill="none" stroke="#fcc400" stroke-width="4" stroke-miterlimit="10" cx="80.6" cy="80.6" r="62.1"/>
    						<path class="path" fill="none" stroke="#fcc400" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" d="M113 52.8l-38.9 55.6-25.9-22"/>
    						<circle class="spin" fill="none" stroke="#555555" stroke-width="4" stroke-miterlimit="10" stroke-dasharray="12.2175,12.2175" cx="80.6" cy="80.6" r="73.9"/>
    					</svg>
    				</div>
    				<h2>Thank You! 😊</h2>
    			</div>
    			<a href="index.php">Continue To Home Page...</a>
    		</div>
    	</div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
<?php
  require_once "db.php";
    if (isset($_POST['signup'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $error = false;
        /*if (!preg_match("/^[ء-يA-Za-z\s]*$/",$name)) {
            $name_error = "Name must contain only alphabets and space in English"; $error = true;
        }
        if (!preg_match("/^[1-9]*$/",$faculty)) {
            $name_error = "Faculty Name must contain only alphabets and space in English"; $error = true;
        }*/
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $email_error = "Please Enter Valid Email ID"; $error = true;
        }

        if(strlen($mobile) < 11 or !preg_match("/[0-9]/", $mobile)) {
            $mobile_error = "Mobile number must be minimum of 11 characters and numbers only!"; $error = true;
        }
        $sql = "SELECT * FROM users WHERE email = '$email' or mobile = '$email'";
        if ($result=mysqli_query($conn,$sql))
        {
          // Check no of rows
          if(mysqli_num_rows($result))
          {
            $user_error = "This Person already exists";
            $error = true;
          }
        }
        if (!$error) {
            if(mysqli_query($conn, "INSERT INTO users(name, email, mobile, faculty, status) VALUES('" . $name . "', '" . $email . "', '" . $mobile . "', '" . $faculty . "', '" . $status . "')")) {
             exit();
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
        }
        //mysqli_close($conn);
    }
    if (isset($_POST['submit_message'])) {
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $subject = mysqli_real_escape_string($conn, $_POST['subject']);
      $message = mysqli_real_escape_string($conn, $_POST['message']);
      $error = false;
      /*if (!preg_match("/^[ء-يA-Za-z\s]*$/",$name)) {
          $name_error = "Name must contain only alphabets and space in English"; $error = true;
      }*/
      if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
          $email_error = "Please Enter Valid Email"; $error = true;
      }
      if($message == null) {
          $message_error = "Please Enter Your Message"; $error = true;
      }
      if (!$error) {
          if(mysqli_query($conn, "INSERT INTO `messages` (`message_id`, `name`, `email`, `subject`, `message`) VALUES(null, '" . $name . "', '" . $email . "', '" . $subject . "', '" . $message . "')")) {
           exit();
          } else {
             echo "Error: " . $sql . "" . mysqli_error($conn);
          }
      }
      mysqli_close($conn);

    }
?>
