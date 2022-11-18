<!-- Student Name: James Caleb Way
Program Name: Rae Riding Lessons
Creation Date: 9/17/2022
Last Modified Date: 11/9/2022
CSCI Course: CSCI 495
Grade Received: TBA
Design Comments: -->

<?php
    session_start();

    if (isset($_SESSION['user_id']))
    {
        unset($_SESSION['user_id']);
    }

    header("Location: http://raeridinglessons.infinityfreeapp.com/index.php");
    die;
?>
