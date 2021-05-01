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
    $breed = $_POST['breed'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $hobbies = $_POST['hobbies'];
    $age = $_POST['age'];
    $size = $_POST['size'];
    $status =$_POST['status'];
    $id = $_POST['animalId'];
    //variable for upload images errors is initialized
    $uploadError = '';

    $image = file_upload($_FILES['image'], 'animal');// "hotel" -> for the upload function (hotels-level)
    if($image->error===0){
        ($_POST["image"]=="animal.png")?: unlink("../../pictures/$_POST[image]");           
        $sql = "UPDATE animals SET anName = '$name', breed = '$breed', anLocation = '$location', description = '$description', hobbies = '$hobbies', anAge = $age, fk_sizeId = $size, status = '$status', anImage = '$image->fileName' WHERE animalId = {$id}";
    }else{
        $sql = "UPDATE animals SET anName = '$name', breed = '$breed', anLocation = '$location', description = '$description', hobbies = '$hobbies', anAge = $age, fk_sizeId = $size, status = '$status'  WHERE animalId = {$id}";
    }    
    if ($connect->query($sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($image->error !=0)? $image->ErrorMessage :'';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . $connect->error;
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
        <title>CR11 Mario</title>
        <?php require_once '../../components/boot.php'?> 
        <link rel="stylesheet" href="../../css/styles.css">
    </head>
    <body>
            <!--Navbar-component-->
    <?php include_once "../../components/navbar3.php";?>
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Update request response</h1>
            </div>
            <div class="alert alert-<?php echo $class;?> shadow-css rounded" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../update.php?id=<?=$id;?>'><button class="btn btn-warning" type='button'>Back</button></a>
                <a href='../admin_panel.php'><button class="btn btn-success" type='button'>Home</button></a>
            </div>
        </div>
        <!--Footer-component-->
        <?php include_once "../../components/footer.php";?>
    </body>
</html>