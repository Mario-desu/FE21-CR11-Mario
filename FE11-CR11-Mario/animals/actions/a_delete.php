<?php 
session_start();

if (isset($_SESSION[ 'user']) != "") {
   header("Location: ../../home.php");
   exit;
}

if  (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
   header("Location: ../../index.php" );
    exit;
}


require_once '../../components/db_connect.php';

if ($_POST) {
    $id = $_POST['id'];
    $image = $_POST['image'];
    ($image =="animal.png")?: unlink("../../pictures/$image");

    $sql = "DELETE FROM animals WHERE animalId = {$id}";
    if ($connect->query($sql) === TRUE) {
        $class = "success";
        $message = "Successfully Deleted!";
    } else {
        $class = "danger";
        $message = "The entry was not deleted due to: <br>" . $connect->error;
    }
    $connect->close();
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>CR11 Mario</title>
        <?php require_once '../../components/boot.php'?>  
        <link rel="stylesheet" href="../../css/styles.css">
    </head>
    <body>
            <!--Navbar-component-->
    <?php include_once "../../components/navbar3.php";?>
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Delete request response</h1>
            </div>
            <div class="alert alert-<?=$class;?> shadow-css rounded" role="alert">
                <p><?=$message;?></p>
                <a href='../admin_panel.php'><button class="btn btn-success" type='button'>Home</button></a>
            </div>
        </div>
        <!--Footer-component-->
        <?php include_once "../../components/footer.php";?>
    </body>
</html>