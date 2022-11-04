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
        <script type='text/javascript' src='http://raeridinglessons.infinityfreeapp.com/functions/popupBox.js'></script>

        <!--needed for popup box-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

        <!-- Library for hamburger menu icon -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/navBar.css'>
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/stylesheet.css'>
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/calendar.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css'/>
        <link href='https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap' rel='stylesheet'/>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> <!--new-->
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/popupBox.css' />
        <title>Rae Riding Lessons | About</title>
        <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    </head>

    <body>
        <!-- Navigation menu addapted from https://www.w3schools.com/howto/howto_js_topnav_responsive.asp -->
        <div class='topnav' id='myTopnav'>
            <a href='index.php' style="float: left">Rae Riding Lessons</a>
            <?php loginButton() ?>
            <a href='about.php' class="active">About</a>
            <a href='lesson.php'>Schedule A Lesson</a>
            <a href='index.php'>Home</a>
            <a href='javascript:void(0);' class='icon' onclick='myFunction()'>
                <i class='fa fa-bars'></i>
            </a>
        </div>
        <!-- End Navigation Menu -->

        <br><br><br> <!--new-->
        <div class="w3-container"> <!--trying to add a box model to contain content-->
        <img src="http://raeridinglessons.infinityfreeapp.com/images/Rae%20Riding%20Lessons%20Logo-min.png" alt="close up of horse face with someone on its back" style="width:250px; height:300px;">
        <center><h1>About</h1></center>
        <center><p class='paragraph'>Hi! I'm Rae, the Lead Trainer and owner of Rae Riding Lessons.
             Here at this business, we want to build special relationships with the horses and the clients.
              We offer group lessons for beginners, intermediate, and advance!
               If you're not too comfortable with a group or would like to have a more one on one time with learning on how to ride horses, 
               then we offer appointments for singles too and would be happy to help and meet your needs.
               If you would like to contact us for more information or to ask questions, you can contact us with the information listed below.</p> </center>
               
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
              </p></center>
              <!--should create popup box upon clicking-->
              <center><a class="trigger_popup_fricc">Terms & Conditions</a>
              <a class="trigger_popup_fricc"> Privacy</a></center>
              <div class="hover_bkgr_fricc">
                <span class="helper"></span>
                <div>
                    <div class="popupCloseButton">&times;</div> <!--content upon clicking-->
                    <center><p>Your access to and use of the Service is conditioned on 
                        <br>Your acceptance of and compliance with these Terms and Conditions.
                        <br>These Terms and Conditions apply to all visitors, users and others who access or use the Service.
                        <br>By accessing or using the Service You agree to be bound by these Terms and Conditions.
                        <br>If You disagree with any part of these Terms and Conditions then You may not access the Service.
                        <br>Your access to and use of the Service is also conditioned on 
                        <br>Your acceptance of and compliance with the Privacy Policy of the Company.
                        <br>Our Privacy Policy describes Our policies and procedures on the collection,
                        <br>use and disclosure of Your personal information when You use the Application or 
                        <br>the Website and tells You about Your privacy rights and how the law protects You.
                        <br>Please read Our Privacy Policy carefully before using Our Service.</p>
                        <!--<a> read more...</a> open new tab to show full terms and conditions-->
                    </p></center>
                </div>
              </div> <!--hover_bkgr_fricc-->
          </div><!--footer-->
        </div><!--w3 container-->
    </body>
</html>