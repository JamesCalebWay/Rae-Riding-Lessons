<!-- Student Name: James Caleb Way
Program Name: Rae Riding Lessons
Creation Date: 9/17/2022
Last Modified Date: 11/9/2022
CSCI Course: CSCI 495
Grade Received: TBA
Design Comments: Paul McGlothlin improved the input feilds. Making the required and added input checking with error messages -->

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
            <input id="text" type="text" name="first_name" placeholder="Rae" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>" required autofocus><br><br>
            Last Name
            <input id="text" type="text" name="last_name" placeholder="Lessons" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : '' ?>" required><br><br>
            Email
            <input id="text" type="text" name="email" placeholder="raeRidingLessons@admin.com" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" required><br><br>
            Phone
            <input id="text" type="text" name="phone" placeholder="8438675309" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>" required><br><br>
            Street Address
            <input id="text" type="text" name="address" placeholder="325 Some Address Ln." value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>" required><br><br>
            City
            <input id="text" type="text" name="city" placeholder="North Charleston" value="<?php echo isset($_POST['city']) ? $_POST['city'] : '' ?>" required><br><br>
            State
            <br>
            <select name="state" value="<?php echo isset($_POST['state']) ? $_POST['state'] : '' ?>" required>
               <option disabled selected>...</option>
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
            <input id="text" type="text" name="zip" placeholder="29405" value="<?php echo isset($_POST['zip']) ? $_POST['zip'] : '' ?>" required><br><br>
            Password
            <input id="text" type="password" name="password" placeholder="examplepassword123" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" required><br><br>

            <input id="button" type="submit" value="Signup"><br><br>

            <a href="login.php">Already have an Acount?</a><br><br>
         </form>
      </div>
   </body>
</html>
