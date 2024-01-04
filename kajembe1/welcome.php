<?php
session_start();
if(!isset($_SESSION['stud'])){
    header('Location:login.php');
}

include('config/db_connect.php');

//$admNo = $studName = $email = $password = $repeatPassword = "";
$sql="SELECT admNo, studName, email FROM userreg";
$result=mysqli_query($conn,$sql);
$stud = mysqli_fetch_array($result);
print_r($result);
echo "<br>". $stud['studName']; 
?>

<html lang="en">
    <?php include('templates/studHeader.php'); ?>


   


    
    <div class="post-list w-100 p5 center">
    
        <table class="table table-bordered">
            <thead>
                <th>Admission number</th>
                <th>Student name</th>
                <th>E-mail</th>
            </thead>
            <tbody>
                <?php 
               /* $sql="SELECT admNo, studName, email FROM userreg";
                $result=mysqli_query($conn,$sql);
                print_r($result);*/

                while($data = mysqli_fetch_array($result)){?><!-- PROBLEM-->
                <tr>
                    <td> <?php echo $data['admNo'];?></td>;
                    <td> <?php echo $data['studName'];?></td>
                    <td> <?php echo $data['email'];?></td>;
                </tr>
               <?php } ?>
            </tbody>
        </table>
    </div>

    </div>
    




    <?php include('templates/studFooter.php'); ?>
