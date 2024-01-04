<?php
session_start();
if(isset($_SESSION['stud'])){
    header('Location:welcome.php');
}

include('config/db_connect.php');


//$admNo = $studName = $email = $password = $repeatPassword = "";
?>

<html lang="en">
    <?php include('templates/header.php'); ?>

    <div class="container">
        <?php
        if (isset($_POST['registar'])) {
            $studName = $_POST['studName'];
            $admNo = $_POST['admNo'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $repeatPassword = $_POST['repeatPassword'];

             // Hash the password before storing it in the database for security
             $passwordHash = password_hash($password, PASSWORD_DEFAULT);
             
            $errors = [];
            if (empty($studName) || empty($admNo) || empty($email) || empty($password) || empty($repeatPassword)) {
                array_push($errors, "All fields are required");
            }
            if (!preg_match('/^[0-9]+/', $admNo)) {
                array_push($errors, "Admission number must be numbers only");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, 'Invalid E-mail');
            }
            $sql="SELECT * FROM userreg WHERE email = '$email'";
            $result= mysqli_query($conn,$sql);
            $rowCount=mysqli_num_rows($result);
            if($rowCount>0){
                array_push($errors,'E-mail already Exist');
            }

            if (strlen($password) < 6) {
                array_push($errors, 'Password must not be less than 6 characters');
            }
            if ($password !== $repeatPassword) {
                array_push($errors, 'Passwords don\'t match');
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = 'INSERT INTO userreg(admNo, studName, email, password) VALUES(?,?,?,?)';

                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

                if ($prepareStmt) {
                    // Use $passwordHash instead of $password
                    mysqli_stmt_bind_param($stmt, "ssss", $admNo, $studName, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);

                   
                    echo "<div class='alert alert-success'>Registration Successful.</div>";
                } else {
                    die('Binding Unsuccessful!');
                }
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
                <input type="submit" value="Registar" name="registar" class="btn form-control">
            </div>
        </form>
    </div>
    <div class='center'><p><a href="loginRevise.php">Login</a> here if already registered</p></div>

    <?php include('templates/footer.php'); ?>
</html>
