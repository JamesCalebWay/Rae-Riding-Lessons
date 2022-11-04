<?php
    session_start();

    include("functions/connection.php");
    include("functions/functions.php");

   if(isset($_SESSION['url']))
   {
      $url = $_SESSION['url']; // Holds url for last page visited.
   }
   else 
   {
      $url = "index.php"; // Default page.
   }

   $emailErr = $passwordErr = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the user entered an email and password.
        if (!empty($email) && !empty($password))
        {
            $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

            $result = mysqli_query($con, $query);

            // Checks if the email exists in the database.
            if ($result && mysqli_num_rows($result) > 0)
            {
               $user_data = mysqli_fetch_assoc($result);

               // Checks if the password is assigned to the user.
               if ($user_data['password'] === $password)
               {
                  $_SESSION['user_id'] = $user_data['user_id'];

                  // Redirects to home page after login.
                  header("Location: $url");
                  die;
               }
            }

            if (empty($_POST["email"])) 
            {
               $emailErr = "Please enter your email";
            }
   
            if (empty($_POST["password"])) 
            {
               $passwordErr = "Please Enter your password";
            }
           
            echo "Wrong email or password!";
        }
        else
        {
            echo "Please enter information!";
        }
    }
?>

<!DOCTYPE html>
<html>
   <head>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/stylesheet.css'>
      <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/login.css'>
      <title>Rae Riding Lessons | Login</title>
      <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
   </head>

   <body>
      <div id="box">
         <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <a id="back" href="javascript:history.back()" class="previous">&lsaquo;</a>
            <br><br>

            <div style="font-size: 20px; margin: 10px">Login</div>

            Email<span class="error">* <?php echo $emailErr;?></span>
            <input id="text" type="text" name="email"><br><br>
            Password<span class="error">* <?php echo $passwordErr;?></span>
            <input id="text" type="password" name="password"><br><br>

            <input id="button" type="submit" value="Login"><br><br>

            <a href="signup.php">Need an Acount?</a><br><br>
         </form>
      </div>
   </body>
</html>