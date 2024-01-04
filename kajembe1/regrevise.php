<?php
   include('config/db_connect.php');

  $admNo= $studName= $email= $password= $repeatPassword="";
?>

<html lang="en">
    <?php  include('templates/header.php'); ?>

    <div class="container">
         <?php
                        // print_r($_POST);
                    //$admNo= $studName= $email= $password= $repeatPassword="";

        if(isset($_POST['submit'])){
            $studName=$_POST['studName'];
            $admNo=$_POST['admNo'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $repeatPassword=$_POST['repeatPassword'];
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors=[];
            if(empty($studName) OR empty($admNo) OR empty($email) OR empty($password) OR empty($repeatPassword)){
                array_push($errors,"all fields are required");
            //  print_r($errors);
            }
            if(!preg_match('/^[0-9]+/', $admNo)){
                //$errors['admNo']="Must be numbers only.<br/>";
                array_push($errors,"Admission number Must be numbers only");
            } 
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors,'invalid E-mail');
            }
            if(strlen(($password)<6)){
                array_push($errors,'Password MUST not be less than 6 characters');
            }
            if($password!==$repeatPassword){
                array_push($errors,'Passwords dont match');
            }

            if(count($errors)>0){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }



        }else{
            //include('config/db_connect.php');

            //require_once('config/db_connect.php');

           // $sql='INSERT INTO userreg(admNo, studName, email, password)VALUES($admNo, $studName, $email, $password)';//insecure!?
            
           $sql='INSERT INTO userreg(admNo, studName, email, password)VALUES(?,?,?,?)';

            $stmt = mysqli_stmt_init($conn);
            $prepareStmt= mysqli_stmt_prepare($stmt, $sql);

            if($prepareStmt){
                mysqli_stmt_bind_param($stmt,"ssss",$admNo, $studName, $email,$password);
                mysqli_stmt_execute($stmt);
                echo "<divclass='alert alert-success'> Registration Successful.</div>";
            }else{
                die('Binding Unsuccessful!');
            }
        }
        ?>

        <form action="registration.php" method="POST">
            <div class="form-group brand-text">
                <div class="form-group">
                <input type="text" name="studName" placeholder="Full Name">
                </div>

                <div class="form-group">
                <input type="text" name="admNo" placeholder="Admission Number">
                </div>

                <div class="form-group">
                <input type="text" name="email" placeholder="E-mail">
                </div>

                <div class="form-group">
                <input type="password" name="password" placeholder="Password">
                </div>

                <div class="form-group">
                <input type="password" name="repeatPassword" placeholder="Repeat Password">
                </div>


            </div>
            <div class="form-group center">
                <input type="submit" value="Registar" name="submit" class="btn">
            </div>


        </form>
        
    </div>

    <?php include('templates/footer.php');  ?>
</html>

    