<!-- Student Name: James Caleb Way
Program Name: Rae Riding Lessons
Creation Date: 9/17/2022
Last Modified Date: 11/9/2022
CSCI Course: CSCI 495
Grade Received: TBA
Design Comments: Karina Quick created the footer and populated the page with content. -->

<?php
    session_start();
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];

    include("functions/connection.php");
    include("functions/functions.php");
    include("functions/calendar.php");

    // Checks if user is logged in.
    $user_data = check_login($con);
    $userIDNum = $user_data['user_id'];

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if ($_POST['info'])
        {
            // Default error messages.
            $info_error = "";
            $password_error = "";

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];
            $password = $_POST['password'];

            if (empty($first_name) || empty($last_name) || empty($email) || empty($address) || empty($city) || empty($state) || empty($zip))
            {
                $info_error = "Please enter valid information!";
            }
            else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $info_error = "Invalid Email Format.";
            }
            else
            {
                $infoQuery = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', address='$address', city='$city', state='$state', zip='$zip' WHERE user_id='$userIDNum'";
                
                mysqli_query($con, $infoQuery);
                
                // Refresh Page to display any new data.
                echo "<meta http-equiv='refresh' content='0'>";
                $info_error = "Changes Saved!";
            }
        }
        else if ($_POST['newPass'])
        {
            $password = $_POST['password'];
            $new_password = $_POST['new_password'];

            if ($password == $new_password)
            {
                $newPassQuery = "UPDATE users SET password='$password' WHERE user_id='$userIDNum'";
                
                mysqli_query($con, $newPassQuery);
                
                // Refresh Page to display any new data.
                echo "<meta http-equiv='refresh' content='0'>";
                $password_error = "Password Changed!";
            }
            else
            {
                $password_error = "The passwords do not match!";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <script type='text/javascript' src='http://raeridinglessons.infinityfreeapp.com/functions/navBar.js'></script> 
        <script type='text/javascript' src='http://raeridinglessons.infinityfreeapp.com/functions/popupBox.js'></script>

        <!--needed for popup box-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

        <!-- Used for the user info update form -->
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/login.css'>

        <!-- Library for hamburger menu icon -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/navBar.css'>
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/stylesheet.css'>
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/calendar.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css'/>
        <link href='https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap' rel='stylesheet'/>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> <!--new-->
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/popupBox.css' />
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/hoverBox.css' />
        <link rel="icon" type="image/x-icon" href="http://raeridinglessons.infinityfreeapp.com/images/favicon.ico">
        <title>Rae Riding Lessons | Profile</title>
                
        <!--Font style-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rye&display=swap" rel="stylesheet">
    </head>

    <body>
        <!-- Navigation menu addapted from https://www.w3schools.com/howto/howto_js_topnav_responsive.asp -->
        <div class='topnav' id='myTopnav'>
            <a href='index.php' style="float: left"><img src="http://raeridinglessons.infinityfreeapp.com/images/RaeLogo.png" alt="Rae Riding Lessons" style="width:81px; height:50px;"></img></a> <!-- resized-->
            <a href='http://raeridinglessons.infinityfreeapp.com/functions/logout.php'>Logout</a>
            <a href='http://raeridinglessons.infinityfreeapp.com/userProfile.php' class="active">Profile</a>
            <a href='about.php'>About</a>
            <a href='lesson.php'>Schedule A Lesson</a>
            <a href='index.php'>Home</a>
            <a href='javascript:void(0);' class='icon' onclick='myFunction()'>
                <i class='fa fa-bars'></i>
            </a>
        </div>
        <!-- End Navigation Menu -->

        <br><br><br>
        <div class="w3-container">
        <center><h1 class="h1">Profile</h1></center>
        
        <br><br><br>
        <?php echo $user_data['first_name'], " ", $user_data['last_name'];?>

        <br><br><br>
        <?php calendar() ?>

        <div id="box"> <!-- User Info updater form -->
            <form method="POST">               
                <br><br>
                <div style="font-size: 25px; margin-bottom: 15px">Update Info</div>
                
                First Name
                <input id="text" type="text" name="first_name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : $user_data['first_name'] ?>" required><br><br>
                Last Name
                <input id="text" type="text" name="last_name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : $user_data['last_name'] ?>" required><br><br>
                Email
                <input id="text" type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $user_data['email'] ?>" required><br><br>
                Phone
                <input id="text" type="text" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $user_data['phone'] ?>"><br><br>
                Street Address
                <input id="text" type="text" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : $user_data['address'] ?>" required><br><br>
                City
                <input id="text" type="text" name="city" value="<?php echo isset($_POST['city']) ? $_POST['city'] : $user_data['city'] ?>" required><br><br>
                State
                <br>
                <select id="text" name="state" value="<?php echo isset($_POST['state']) ? $_POST['state'] : $user_data['state'] ?>" required>
                    <option disabled selected><?php echo isset($_POST['state']) ? $_POST['state'] : $user_data['state'] ?></option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">Washington DC</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
                <br><br> 
                Zip
                <input id="text" type="text" name="zip" value="<?php echo isset($_POST['zip']) ? $_POST['zip'] : $user_data['zip'] ?>" required><br><br>
                <?php echo $info_error ?><br>
                <input id="button" name="info" type="submit" value="Update"><br><br>
            </form>
            <form method="POST">
            <br><br>
                <div style="font-size: 25px; margin-bottom: 15px">Change Password</div>
                
                New Password
                <input id="text" type="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" required><br><br>
                Confirm New Password
                <input id="text" type="password" name="new_password" value="<?php echo isset($_POST['new_password']) ? $_POST['new_password'] : '' ?>" required><br><br>
                
                <?php echo $password_error ?><br>
                <input id="button" name="newPass" type="submit" value="Change"><br><br>
            </form>
       </div>

        <div class="footer">
            <!-- This is where the contact info is-->
            <center><p class="paragraph">
                Contact Info:
                <br>
                <?php 
                    $busInfo = "SELECT email, phone, address, city, state, zip FROM `users` WHERE admin=1";

                    $res = mysqli_query($con, $busInfo);
                    $busRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
                    $busPhone = $busRow['phone'];

                    echo $busRow['email'];
                    echo "<br>";
                    echo "(", substr($busPhone, 0, 3), ")-", substr($busPhone, 3, 3), "-", substr($busPhone, 6, 4);
                    echo "<br>";
                    // 325 Some Address Ln., North Charleston, SC, 29405
                    echo $busRow['address'], ", ", $busRow['city'], ", ", $busRow['state'], ", ", $busRow['zip'];
                ?>
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
