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

require_once '../../components/db_connect.php' ;
require_once '../../components/file_upload.php';

if ($_POST) {   
    $name = $_POST['animal_name'];
    $location = $_POST['location'];
    $breed = $_POST['breed'];
    $description = $_POST['description'];
    $hobbies = $_POST['hobbies'];
    $age = $_POST['age'];
    $size = $_POST['size'];
    $uploadError = '';
    //this function exists in the service file upload.
    $image = file_upload($_FILES['image'], 'animal');  // "hotel" -> for the upload function (hotels-level)
   
    $sql = "INSERT INTO animals (anName, breed, anLocation, description, hobbies, anAge, fk_sizeId, anImage) VALUES ('$name', '$breed', '$location', '$description', '$hobbies', $age, $size, '$image->fileName')";

    if ($connect->query($sql) === true) {
        $class = "success";
        $message = "The entry below was successfully created <br>
            <table class='table w-50'><tr>
            <td> $name </td>
            <td> $location </td>
            <td> $breed </td>
            <td> $age </td>
            </tr></table><hr>";
        $uploadError = ($image->error !=0)? $image->ErrorMessage :'';
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
        $uploadError = ($image->error !=0)? $image->ErrorMessage :'';
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
        <title>CR1 Mario</title>
        <?php require_once '../../components/boot.php'?>
    </head>
    <body>
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Create request response</h1>
            </div>
            <div class="alert alert-<?=$class;?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../index.php'><button class="btn btn-primary" type='button'>Home</button></a>
            </div>
        </div>
    </body>
</html>