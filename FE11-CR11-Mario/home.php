<?php
session_start();
require_once 'components/db_connect.php';

// if adm will redirect to dashboard
if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// select logged-in users details - procedural style
$res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome - <?php echo $row['f_name']; ?></title>
        <?php require_once 'components/boot.php'?>
        <link rel="stylesheet" href="css/styles.css">
        <style>
            .userImage{
                width: 200px;
                height: 200px;
            }
            .hero {
                background: rgb(2,0,36);
                background: linear-gradient(24deg, rgba(2,0,36,1) 0%, rgba(0,212,255,1) 100%);   
            }
        </style>
    </head>
    <body>
                   <!--Navbar-component-->
    <?php include_once "components/navbar1.php";?>
        <div class="container">
            <div class="hero shadow-css rounded bg-light p-3 mt-5">
                <img class="userImage" src="pictures/<?php echo $row['image']; ?>" alt="<?php echo $row['f_name']; ?>">
                <p class="text-white" >Hi <?php echo $row['f_name']; ?></p>
            </div>
            <a href="logout.php?logout">Sign Out</a><br>
            <a href="update.php?id=<?php echo $_SESSION['user'] ?>">Update your profile</a>
        </div>
    <!--Footer-component-->
    <?php include_once "components/footer.php";?>
    </body>
</html>