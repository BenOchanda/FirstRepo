<?php
session_start();
if(isset($_SESSION['stud'])){
    header('Location:welcome.php');
}

include('config/db_connect.php');

$admNo = $password = "";
$errors = array('admNo' => '', 'password' => '');

if (isset($_POST['login'])) {
    $admNo = $_POST['admNo'];
    $password = $_POST['password'];

    //====CHECK Admission Number====
    if (empty($_POST['admNo'])) {
        $errors['admNo'] = 'Admission Number is Required <br/>';
    } else {
        $admNo = $_POST['admNo'];
        if (!preg_match('/^[0-9]+/', $admNo)) {
            $errors['admNo'] = "Must be numbers only.<br/>";
        }
    }
    if (empty($_POST['password'])) {
        $errors['password'] = "Password is required.<br>";
    }
    //DISPLAYING ERRORS AND WORKING WITH DATABASE
    if (array_filter($errors)) {
        echo "ERRORS in the form";
    } else {
        // Use parameterized query to prevent SQL injection
        $sql = "SELECT * FROM userreg WHERE admNo = ?";

        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "s", $admNo);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Get the result
            $result = mysqli_stmt_get_result($stmt);

            // Fetch the user data
            $stud = mysqli_fetch_assoc($result);

            if ($stud) {
                if (password_verify($password, $stud["password"])) {
                    
                    
                    session_start();
                    //$_SESSION['stud']='yes';
                    $_SESSION['stud']="yes";

                    header('Location: welcome.php');
                } else {
                    $errors['password'] = "Incorrect Password.<br>";
                }
            } else {
                echo "<div class='alert alert-danger'> No such Admission Number in the system<p> please <a href='registration.php'>Register</a></div>";
            }
        }
    }
}
?>

<html lang="en">
    <?php include('templates/header.php'); ?>

    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="admNo">Admission Number:
                <input type="text" name="admNo" value="<?php echo htmlspecialchars($admNo); ?>" placeholder="Enter Admission Number:" class="form-control">
            </label>

            <div class="red-text">
                <?php echo $errors['admNo']; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Password:
                <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>" placeholder="Enter Password:" class="form-control">
            </label>

            <div class="red-text">
                <?php echo $errors['password']; ?>
            </div>
        </div>
        <div class="form-group center">
            <input type="submit" value="Login" name="login" class="btn">
        </div>
    </form>

    <?php include('templates/footer.php'); ?>
</html>
-