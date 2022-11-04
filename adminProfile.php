<?php
    session_start();
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];

    include("functions/connection.php");
    include("functions/functions.php");
    include("functions/calendar.php");

    // Checks if user is logged in.
    $user_data = check_login($con);

    if ($user_data['level'] != "Admin")
    {
        // Redirect to login.
        echo "<script> location.href='http://raeridinglessons.infinityfreeapp.com/index.php'; </script>";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if ($_POST['lesson'])
        {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $slots = $_POST['slots'];
            $level = $_POST['level'];

            if (!empty($title) && !empty($description) && !empty($date) && !empty($start_time) && !empty($end_time) && !empty($slots) && !empty($level))
            {
                $query = "INSERT INTO events (title, description, date, start_time, end_time, slots, level) VALUES ('$title', '$description', '$date', '$start_time', '$end_time', '$slots', '$level')";
            
                mysqli_query($con, $query);

                // Refresh Page to display any new data.
                header("Refresh:0");
            }
            else
            {
                echo "Please enter valid information!";
            }
        }
        else if ($_POST['note'])
        {
            $note = $_POST['mytextarea'];
            $userIDNum = $_POST['userIDNum'];

            $noteQuery = "UPDATE users SET notes='$note' WHERE user_id='$userIDNum'";
            
            mysqli_query($con, $noteQuery);
        }
        else if ($_POST['skillLevel'])
        {
            $skillLevel = $_POST['skillLevel'];
            $userIDNumSkill = $_POST['userIDNumSkill'];

            $skillQuery = "UPDATE users SET level='$skillLevel' WHERE user_id='$userIDNumSkill'";
            
            mysqli_query($con, $skillQuery);
        }
        else if ($_POST['news'])
        {
            $news = $_POST['newsTextArea'];
            $newsQuery = "UPDATE users SET news='$news' WHERE user_id='92233'";
            
            mysqli_query($con, $newsQuery);
        }
        else
        {
            echo "Well we tried!";
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

        <!-- Library for hamburger menu icon -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/navBar.css'>
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/stylesheet.css'>
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/calendar.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css'/>
        <link href='https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap' rel='stylesheet'/>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> <!--new-->
        <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/popupBox.css' />
        <title>Rae Riding Lessons | Admin</title>
        <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    </head>

    <body>
        <!-- Navigation menu addapted from https://www.w3schools.com/howto/howto_js_topnav_responsive.asp -->
        <div class='topnav' id='myTopnav'>
        <a href='index.php' style="float: left">Rae Riding Lessons</a>
        <a href='http://raeridinglessons.infinityfreeapp.com/functions/logout.php'>Logout</a>
            <a href='http://raeridinglessons.infinityfreeapp.com/adminProfile.php' class="active">Admin</a>
            <a href='about.php'>About</a>
            <a href='lesson.php'>Schedule A Lesson</a>
            <a href='index.php'>Home</a>
            <a href='javascript:void(0);' class='icon' onclick='myFunction()'>
                <i class='fa fa-bars'></i>
            </a>
        </div>
        <!-- End Navigation Menu -->

        <br><br><br>
        <div class="w3-container"> <!--a box model to contain content--><!--new see if breaks-->
        <center><h1>Admin</h1></center>
    
        <br><br><br>
        <?php calendar() ?>

        <br><br><br>
        <center>
        <div class="addNews">
            <b><big>Add News</big></b>
            <?php
                $oldNewsQuery = "SELECT news FROM `users` WHERE user_id=92233";

                $oldNews = mysqli_query($con, $oldNewsQuery);
                $newsRow = mysqli_fetch_array($oldNews, MYSQLI_ASSOC);

                echo "<form method='post'>
                <textarea name='newsTextArea' rows='10' cols='80'>", $newsRow['news'], "</textarea><br><br>
                <input type='submit' name='news' value='Add News' />
            </form>";
            ?>
        </div>
        </center>

        <br><br><br>
        <div class="usertable">
                <?php
                    $query = "SELECT * FROM `users`";

                    $result = mysqli_query($con, $query);

                    echo "<table class='table'>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Level</th>
                            <th>Notes</th>";
                            
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                        echo "<tr class='userInfo'>";
                        echo "<td>", $row['first_name'], " ", $row['last_name'], "</td>";
                        echo "<td>", $row['phone'], "</td>";
                        echo "<td>", $row['email'], "</td>";
                        echo "<td>", $row['address'], " ", $row['city'], ", ", $row['state'], " ", $row['zip'], "</td>";
                        echo "<td>
                                <form id='skillForm' method='post'>
                                <input type='hidden' name='userIDNumSkill' value='", $row['user_id'], "' />
                                <select name='skillLevel'  onchange='this.form.submit()'>
                                    <option disabled selected>", $row['level'], "</option>
                                    <option value='Beginner'>Beginner</option>
                                    <option value='Intermediate'>Intermediate</option>
                                    <option value='Advanced'>Advanced</option>
                                    <option value='Admin'>Admin</option>
                                </select>
                                </form>
                            </td>";
                        echo "<td>
                            <form method='post'>
                                <textarea name='mytextarea'>", $row['notes'], "</textarea><br><br>
                                <input type='hidden' name='userIDNum' value='", $row['user_id'], "' />
                                <input type='submit' name='note' value='Add Note' />
                            </form>
                        </td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                ?>
        </div>

        <div id="box">
         <form method="POST">
            <br><br>
            <div style="font-size: 20px; margin: 10px">Add Lesson</div>
            
            Lesson Type
            <input id="text" type="text" name="title"><br><br>
            Description
            <input id="text" type="text" name="description"><br><br>
            Date
            <input id="text" type="text" name="date"><br><br>
            Start Time
            <input id="text" type="text" name="start_time"><br><br>
            End time
            <input id="text" type="text" name="end_time"><br><br>
            Slots
            <input id="text" type="text" name="slots"><br><br>
            Skill Level
            <input id="text" type="text" name="level"><br><br>

            <input id="button" type="submit" name="lesson" value="Submit"><br><br>
         </form>
      </div>
        
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