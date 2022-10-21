<?php
    // Redirects user to the home page after login.
    function check_login($con)
    {
        if (isset($_SESSION['user_id']))
        {
            $id = $_SESSION['user_id'];
            $query = "SELECT * FROM users WHERE user_id = '$id' LIMIT 1";

            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);

                return $user_data;
            }
        }

        // Redirect to login.
        header("Location: http://raeridinglessons.infinityfreeapp.com/login.php");
        die;
    }
    
    // Does not redirect user.
    function check_login2($con)
    {
        if (isset($_SESSION['user_id']))
        {
            $id = $_SESSION['user_id'];
            $query = "SELECT * FROM users WHERE user_id = '$id' LIMIT 1";

            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);

                return $user_data;
            }
        }

        return 0;
    }

    function random_num($length)
    {
        $text = "";

        if ($length < 5)
        {
            $length = 5;
        }

        $len = rand(4, $length);

        for ($i = 0; $i < $len; $i++)
        {
            $text .= rand(0, 9);
        }

        return $text;
    }

    function loginButton()
    {
        session_start();

        include("functions/connection.php");

        if ($user_data = check_login2($con)) // Checks if user is logged in.
        {
            if ($user_data['admin'] == 0) // Checks if normal user.
            {
                echo "<a href='http://raeridinglessons.infinityfreeapp.com/functions/logout.php'>Logout</a>";
                echo "<a href='http://raeridinglessons.infinityfreeapp.com/userProfile.php'>Profile</a>";
            }
            else if ($user_data['admin'] == 1) // Checks if user is admin.
            {
                echo "<a href='http://raeridinglessons.infinityfreeapp.com/functions/logout.php'>Logout</a>";
                echo "<a href='http://raeridinglessons.infinityfreeapp.com/adminProfile.php'>Admin</a>";
            }
            else
            {
                echo "You done broke all the things!";
            }
        }
        else
        {
            echo "<a href='http://raeridinglessons.infinityfreeapp.com/login.php'>Login</a>";
        }
    }
?>