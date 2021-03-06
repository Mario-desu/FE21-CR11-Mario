<?php
session_start();
require_once 'components/db_connect.php';

// it will never let you open index(login) page if session is set
if (isset($_SESSION['user']) != "") {
    header("Location: home.php");
    exit;
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php"); // redirects to home.php
}

$error = false;
$email = $pass = $emailError = $passError = '';

if (isset($_POST['btn-login'])) {

    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear user invalid inputs

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {

        $pass = hash('sha256', $pass); // password hashing

        $sqlSelect = "SELECT id, f_name, pass, status FROM user WHERE email = ? ";
        $stmt = $connect->prepare($sqlSelect);
        $stmt->bind_param("s", $email);
        $work = $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $result->num_rows;
        if ($count == 1 && $row['pass'] == $pass) {
            if($row['status'] == 'adm'){
                $_SESSION['adm'] = $row['id'];           
                header( "Location: dashboard.php");}
            else{
                $_SESSION['user'] = $row['id']; 
               header( "Location: home.php");
            }          
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }
    }
}
$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login & Registration System</title>
        <?php require_once 'components/bootcss.php'?>
        <!--This will force the CSS to reload.-->
        <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
    </head>
    <body>
        <!--Navbar-component-->
    <?php include_once "components/navbar1.php";?>
        <div class="container">
            <form class="w-75 shadow-css rounded bg-light p-3 mt-5" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                <h2>LogIn</h2>
                <hr/>
                <?php
                if (isset($errMSG)) {
                    echo $errMSG;
                }
                ?>
        
                <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>"  maxlength="40" />
                <span class="text-danger"><?php echo $emailError; ?></span>

                <input type="password" name="pass"  class="form-control mt-2" placeholder="Your Password" maxlength="15"  />
                <span class="text-danger"><?php echo $passError; ?></span>
                <hr/>
                <button button class="btn btn-block btn-primary" type="submit" name="btn-login">Sign In</button>
                <hr/>
                <a href="register.php">Not registered yet? Click here</a>
            </form>
        </div>
        <!--Footer-component-->
        <?php include_once "components/footer_sticky.php";?>
        <!--Bootstrap-JS-component-->
        <?php include_once "components/boot_js.php";?>
    </body>
</html>