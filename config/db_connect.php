<?php 

    //connect to db
    $connection = mysqli_connect('localhost', 'drago', 'user_12345', 'meals_db');

    //check connection
    if(!$connection) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

?>