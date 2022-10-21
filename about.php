<?php
    session_start();
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];

    include("functions/connection.php");
    include("functions/functions.php");

    // // Checks if user is logged in.
    // $user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <script type='text/javascript' src='http://raeridinglessons.infinityfreeapp.com/functions/navBar.js'></script>  
        <!-- Library for hamburger menu icon -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/navBar.css'>
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/stylesheet.css'>
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/calendar.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css'/>
        <link href='https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap' rel='stylesheet'/>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> <!--new-->
        <title>Rae Riding Lessons | About</title>
    </head>

    <body>
        <!-- Navigation menu addapted from https://www.w3schools.com/howto/howto_js_topnav_responsive.asp -->
        <div class='topnav' id='myTopnav'>
            <a href='index.php' style="float: left">Rae Riding Lessons</a>
            <a href='index.php'>Home</a>
            <a href='lesson.php'>Schedule A Lesson</a>
            <a href='about.php' class="active">About</a>
            <?php loginButton() ?>
            <a href='javascript:void(0);' class='icon' onclick='myFunction()'>
                <i class='fa fa-bars'></i>
            </a>
        </div>
        <!-- End Navigation Menu -->

        <br><br><br> <!--new-->
        <div class="w3-container"> <!--trying to add a box model to contain content-->
        <center><h1>About</h1></center>
        <center><p class='paragraph'>Welcome to the Home of Rae and her horses.
             You can go to the About page to learn all about Rae and her business.
              If you're thinking of wanting to schedule a lesson then jump right into the login page where you can create an account.
               If you would like to contact us for more information or to ask questions, you can contact us with the information listed below.</p></center>
               <div class="footer">
            <!-- This is where the contact info is-->
            <center><p class="paragraph">
              Contact Info:
              <br>
              raeRidingLessons@admin.com
              <br>
              (843)-867-5309
              <br>
              325 Some Address Ln., North Charleston, SC, 29405
              <br> <br> <br>
              Copyright 2022 by Blue Team. All Rights Reserved
              <br>
              Terms & Conditions      |      Privacy
              </p></center>
        
          <!--Will create link text to show privacy and terms of use  -->
          </div>
        </div>
    </body>
</html>