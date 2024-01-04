<?php
session_start();
if(isset($_SESSION['stud'])){
    header('Location:welcome.php');
}



include('config/db_connect.php');
//$admNo = $studName = $email = $password = $repeatPassword = "";
    
    $admNo= $password="";
    $errors=array('admNo'=>'','password'=>'');

if(isset($_POST['login'])){
    $admNo=$_POST['admNo'];
    $password=$_POST['password'];

    //====CHECK Admission Number====
    if(empty($_POST['admNo'])){//******* */
        $errors['admNo']= 'Admission Number is Required <br/>';
    }
    else{
        $admNo= $_POST['admNo'];
    if(!preg_match('/^[0-9]+/', $admNo)){
        $errors['admNo']="Must be numbers only.<br/>";
    }           
    }
    if(empty($_POST['password'])){
        $errors['password']="Password is required.<br>";
    }
    //DISPLAYING ERRORS AND WORKING WITH DATABASE
    if(array_filter($errors)){
        echo "ERRORS in the form";
    }
    
    else//******* */
    {

     $sql="SELECT * FROM userreg WHERE admNo = $admNo";

    $result=mysqli_query($conn, $sql);
    
    //$stud= mysqli_fetch_assoc($result);//works fine too
    
    
    $stud= mysqli_fetch_array($result, MYSQLI_ASSOC);
    

                            //echo "<p class='btn'>OWADA</p>";//"($stud['admNo'])";

    if($stud){
        if(password_verify($password, $stud["password"])){
            session_start();
            $_SESSION['stud']=$stud['admNo'];
            header('Location:welcome.php');
        }else{
            $errors['password']="Incorrect Password.<br>";

        }
    }else{
        echo "<div class='alert alert-danger'> No such Admission Number in the system<p> please <a href='registration.php'>Registar</a></div>";
    }
}
}

?>

<html lang="en">
    <?php include('templates/header.php');  
    
    ?>


    <form action="loginRevise.php" method="POST" >
        <div class="form-group">
        <label for="admNo">Addmision Number: 
                <input type="text" name="admNo" value="<?php
                        echo htmlspecialchars($admNo);
                    ?>" placeholder="Enter Admission Number:" class="form-control">
            </label>

            <div class="red-text">
                <?php
                    echo $errors['admNo'];
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Password: 
                <input type="password" name="password" value="<?php
                        echo htmlspecialchars($password);
                    ?>" placeholder="Enter Password:" class="form-control">
            </label>

            <div class="red-text">
                <?php
                    echo $errors['password'];
                ?>
            </div>
        </div>
        <div class="form-group center">
                <input type="submit" value="Login" name="login" class="btn form-control">
            </div>
    </form>
    <div class='center'><p><a href="registration.php">Register</a> here if not yet registered</p></div>



    <?php include('templates/footer.php'); ?>
</html>