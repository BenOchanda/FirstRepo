<?php
include('../config/db_connect.php');

//<?php

if(isset($_POST['update'])){
    $title= mysqli_real_escape_string($conn, $_POST['title']);
    $summary= mysqli_real_escape_string($conn, $_POST['summary']);
    $content= mysqli_real_escape_string($conn, $_POST['content']);
    $date= mysqli_real_escape_string($conn, $_POST['date']);
    $id= mysqli_real_escape_string($conn, $_POST['id']);

    $sql= "UPDATE  posts SET title='$title', summary='$summary', content='$content', date='$date' WHERE id='$id'";
    if(mysqli_query($conn, $sql)){
    }else{
        die("Data not updated!");
    }
    echo "Blog Updated Successfully!";
}
?>