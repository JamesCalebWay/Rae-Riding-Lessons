<!-- Student Name: James Caleb Way
Program Name: Rae Riding Lessons
Creation Date: 9/17/2022
Last Modified Date: 11/9/2022
CSCI Course: CSCI 495
Grade Received: TBA
Design Comments: -->

<?php
    $dbhost = "sql201.epizy.com";
    $dbuser = "epiz_32615472";
    $dbpass = "T854dfaUY87L8d";
    $dbname = "epiz_32615472_xxx";

    if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
    {
        die ("Failed to connect to database!");
    }
?>
