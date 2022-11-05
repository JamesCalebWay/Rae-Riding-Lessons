<?php
    session_start();

    include("functions/connection.php");
    include("functions/functions.php");

        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];
            $password = $_POST['password'];

            if (empty($first_name) || empty($last_name) || empty($email) || empty($address) || empty($city) || empty($state) || empty($zip) || empty($password))
            {
                echo "Please enter valid information!";
            }
            else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
               echo "Invalid Email Format.";
            }
            else
            {
                $user_id = random_num(20);
                $query = "INSERT INTO users (user_id, first_name, last_name, email, phone, address, city, state, zip, password) VALUES ('$user_id', '$first_name', '$last_name', '$email', '$phone', '$address', '$city', '$state', '$zip', '$password')";
            
                mysqli_query($con, $query);

                // After user signs up they get sent to login page
                // Log in is not automatic on signup.
                header("Location: login.php");
                die;
            }
        }
?>

<!DOCTYPE html>
<html>
   <head>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/stylesheet.css'>
      <link rel='stylesheet' href='http://raeridinglessons.infinityfreeapp.com/styles/login.css'>
      <title>Rae Riding Lessons | Signup</title>
      <link rel="icon" type="image/x-icon" href="http://raeridinglessons.infinityfreeapp.com/images/favicon.ico">
   </head>

   <body>
      <div id="box">
         <form method="POST">
            <a id="back" href="javascript:history.back()" class="previous">&lsaquo;</a>
            
            <br><br>
            <div style="font-size: 25px; margin-bottom: 15px">Signup</div>
            
            First Name
            <input id="text" type="text" name="first_name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>" required><br><br>
            Last Name
            <input id="text" type="text" name="last_name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : '' ?>" required><br><br>
            Email
            <input id="text" type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" required><br><br>
            Phone
            <input id="text" type="text" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>" required><br><br>
            Street Address
            <input id="text" type="text" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>" required><br><br>
            City
            <input id="text" type="text" name="city" value="<?php echo isset($_POST['city']) ? $_POST['city'] : '' ?>" required><br><br>
            State
            <input id="text" type="text" name="state" value="<?php echo isset($_POST['state']) ? $_POST['state'] : '' ?>" required><br><br>
            Zip
            <input id="text" type="text" name="zip" value="<?php echo isset($_POST['zip']) ? $_POST['zip'] : '' ?>" required><br><br>
            Password
            <input id="text" type="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" required><br><br>

            <input id="button" type="submit" value="Signup"><br><br>

            <a href="login.php">Already have an Acount?</a><br><br>
         </form>
      </div>
   </body>
</html>