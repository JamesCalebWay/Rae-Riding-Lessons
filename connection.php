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