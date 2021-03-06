<?php
session_start(); // start a new session or continues the previous
if ( isset($_SESSION['user']) != "") {
   header("Location: home.php" ); // redirects to home.php
}
if (isset($_SESSION[ 'adm' ]) != "") {
   header("Location: dashboard.php"); // redirects to home.php
}
require_once  'components/db_connect.php';
require_once 'components/file_upload.php' ;
$error = false;
$fname = $lname = $email = $date_of_birth = $pass = $image = '';
$fnameError = $lnameError = $emailError = $dateError = $passError = $picError = '';

function cleanInput($var){
    // sanitize user input to prevent sql injection
    $result = trim($var);
    //trim - strips whitespace (or other characters) from the beginning and end of a string
    $result = strip_tags($result);
    // strip_tags -- strips HTML and PHP tags from a string
    $result = htmlspecialchars($result);
    // htmlspecialchars converts special characters to HTML entities
    return $result;

}

if (isset($_POST[ 'btn-signup'])) {

   
   $fname = cleanInput($_POST['fname']);

   $lname = cleanInput($_POST['lname']);    

   $email = cleanInput($_POST['email']);
  
   $date_of_birth = cleanInput($_POST['date_of_birth']);
 
   $pass = cleanInput($_POST['pass']);
  

   $uploadError = '';
   $image = file_upload($_FILES['image']);

   // basic name validation
   if (empty($fname) || empty($lname)) {
       $error = true;
       $fnameError = "Please enter your full name and surname";
   } else if (strlen($fname) < 3  || strlen($lname) < 3) {
       $error = true;
       $fnameError = "Name and surname must have at least 3 characters.";
   } else if (!preg_match("/^[a-zA-Z]+$/", $fname) || !preg_match("/^[a-zA-Z]+$/", $lname)) {
       $error = true;
       $fnameError = "Name and surname must contain only letters and no spaces.";
   }
 
   //basic email validation
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $error = true;
       $emailError = "Please enter valid email address.";
   } else {
   // checks whether the email exists or not
       $query = "SELECT email FROM user WHERE email='$email'";
       $result = mysqli_query($connect, $query);
       $count = mysqli_num_rows($result);
       if ($count != 0) {
           $error = true;
           $emailError = "Provided Email is already in use.";
       }
   }
   //checks if the date input was left empty
   if (empty($date_of_birth)) {
       $error = true;
       $dateError = "Please enter your date of birth.";
   }
   // password validation
   if (empty($pass)) {
       $error = true;
       $passError = "Please enter password.";
   } else if (strlen($pass) < 6 ) {
       $error = true;
       $passError = "Password must have at least 6 characters." ;
   }

   // password hashing for security
   $pass = hash('sha256', $pass);
   // if there's no error, continue to signup
    if (!$error) {

       $query = "INSERT INTO user(f_name, l_name, pass, date_of_birth, email, image)
                 VALUES('$fname', '$lname', '$pass', '$date_of_birth', '$email', '$image->fileName')";
       $res = mysqli_query($connect, $query);

       if ($res) {
           $errTyp = "success";
           $errMSG = "Successfully registered, you may login now";
           $uploadError = ($image->error != 0) ? $image->ErrorMessage : '';

       } else {
           $errTyp = "danger";
           $errMSG = "Something went wrong, try again later..." ;
           $uploadError = ($image->error != 0) ? $image->ErrorMessage : '';
       }
   }
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en" >
<head>
   <meta charset="UTF-8">
    <meta name="viewport"   content="width=device-width, initial-scale=1.0">
    <title>Login & Registration System </title>
    <?php require_once  'components/bootcss.php'?>
    <!--This will force the CSS to reload:-->
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">

</head>
<body>
    <!--Navbar-component-->
    <?php include_once "components/navbar1.php";?>
<div class ="container">
    <form class="w-75 shadow-css rounded bg-light p-3 mt-5"  method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off"  enctype="multipart/form-data">
                <h2>Sign Up.</h2>
            <hr/>
            <?php
            if (isset($errMSG)) {
            ?>
            <div class="alert alert-<?php echo $errTyp ?>"  >
                            <p><?php echo $errMSG; ?></p>
                            <p><?php echo $uploadError; ?></p>
            </div>

            <?php
            }
            ?>

            <input type ="text"  name="fname"  class="form-control"   placeholder="First name" maxlength="50" value= "<?php echo $fname ?>"   />
                <span class="text-danger" > <?php echo $fnameError; ?> </span>

                <input type ="text"   name="lname"  class ="form-control mt-2"  placeholder= "Surname" maxlength="50"  value="<?php echo $lname ?>"  />
                <span class="text-danger" > <?php echo  $fnameError; ?> </span>

            <input  type="email"  name="email" class ="form-control mt-2" placeholder ="Enter Your Email" maxlength="40" value = "<?php echo $email ?>"  />
                <span  class="text-danger" > <?php  echo $emailError; ?> </span>
                <div class ="d-flex">
                <input class='form-control w-50  mt-2'  type="date"   name="date_of_birth"  value = "<?php echo $date_of_birth ?>"/>
                    <span  class="text-danger" > <?php  echo $dateError; ?> </span>

                    <input  class='form-control w-50  mt-2' type="file" name= "image" >
                    <span  class= "text-danger" >  <?php   echo  $picError; ?>   </span >
                </div >
                <input   type = "password"   name = "pass"   class = "form-control  mt-2"   placeholder = "Enter Password"   maxlength = "15"   />
                <span   class = "text-danger" >   <?php   echo  $passError; ?>   </span >
                <hr />
                <button   type = "submit"   class = "btn btn-block btn-primary"   name = "btn-signup" > Sign Up </button >
                <hr />
                <a   href = "index.php" > Sign in Here... </a >
    </form >
  </div >
    <!--Footer-component-->
    <?php include_once "components/footer_sticky.php";?>
    <!--Bootstrap-JS-component-->
    <?php include_once "components/boot_js.php";?>
</body >
</html > 