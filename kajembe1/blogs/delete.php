<?php
include('../config/db_connect.php');
   $id=$_GET['id'];
   if($id){
    $sql="DELETE FROM posts WHERE id= $id";
    $result=mysqli_query($conn, $sql);
    // Preffered alternatiuve...if(mysqli_query($conn, $sql)){}.. Though this seem to be woeking fine as well... more tests needed.. if its a loop it would have gone indefinateli, but its a one time selection
   if($result){
    header("Location:index.php");
   }else{
    die ('Something didnt go right');
   }
   }else{
    echo 'Blog Not Found';
   }
?>