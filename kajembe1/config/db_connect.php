<?php
//===CONNECT TO THE DATABASE====
//mysqli_connect(localhostName, dbUser, password, dbName);
    $conn=mysqli_connect('localhost','bae','b1a2e3','kajembe');
    
    //=== CHECK CONNECTION===
    if(!$conn){
        //echo 'Connection Error'.mysqli_connect_error();
        die('db connection error!');
    }
    ?>