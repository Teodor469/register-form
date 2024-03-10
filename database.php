<?php

    $db_server = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "registration";
    $conn = "";


    try{
        $conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);
    }
    catch(mysqli_sql_exception){
        echo "Could not connect!";
    }
    

?>