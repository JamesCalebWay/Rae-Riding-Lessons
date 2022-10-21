<?php
    session_start();
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];

    include("functions/connection.php");
    include("functions/functions.php");
    include("functions/calendar.php");

    // Checks if user is logged in.
    $user_data = check_login($con);

    if ($user_data['admin'] != 1)
    {
        // Redirect to login.
        echo "<script> location.href='http://raeridinglessons.infinityfreeapp.com/index.php'; </script>";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $slots = $_POST['slots'];

            if (!empty($title) && !empty($description) && !empty($date) && !empty($start_time) && !empty($end_time) && !empty($slots))
            {
                $query = "INSERT INTO events (title, description, date, start_time, end_time, slots) VALUES ('$title', '$description', '$date', '$start_time', '$end_time', '$slots')";
            
                mysqli_query($con, $query);

                // After user signs up they get sent to login page
                // Log in is not automatic on signup.
                // header("Location: login.php");
                // die;
            }
            else
            {
                echo "Please enter valid information!";
            }
        }
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
        <title>Rae Riding Lessons | Admin</title>
    </head>

    <body>
        <!-- Navigation menu addapted from https://www.w3schools.com/howto/howto_js_topnav_responsive.asp -->
        <div class='topnav' id='myTopnav'>
            <a href='index.php' style="float: left">Rae Riding Lessons</a>
            <a href='index.php'>Home</a>
            <a href='lesson.php'>Schedule A Lesson</a>
            <a href='about.php'>About</a>
            <a href='http://raeridinglessons.infinityfreeapp.com/functions/logout.php'>Logout</a>
            <a href='http://raeridinglessons.infinityfreeapp.com/adminProfile.php' class="active">Admin</a>
            <a href='javascript:void(0);' class='icon' onclick='myFunction()'>
                <i class='fa fa-bars'></i>
            </a>
        </div>
        <!-- End Navigation Menu -->

        <br><br><br>
        <center><h1>Admin</h1></center>
    
        <br><br><br>
        <?php calendar() ?>

        <br><br><br>
        <div class="usertable">
                <?php
                    $query = "SELECT * FROM `users`";

                    $result = mysqli_query($con,$query);

                    echo "<table class='table'>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Level</th>";
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                        echo "<tr class='userInfo'>";
                        echo "<td>", $row['first_name'], " ", $row['last_name'], "</td>";
                        echo "<td>", $row['phone'], "</td>";
                        echo "<td>", $row['email'], "</td>";
                        echo "<td>", $row['address'], " ", $row['city'], ", ", $row['state'], " ", $row['zip'], "</td>";
                        echo "<td>", $row['level'], "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                ?>
        </div>


        <div id="box">
         <form method="POST">
            <a id="back" href="javascript:history.back()" class="previous">&lsaquo;</a>
            
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

            <input id="button" type="submit" value="Submit"><br><br>
         </form>
      </div>
    </body>
</html>