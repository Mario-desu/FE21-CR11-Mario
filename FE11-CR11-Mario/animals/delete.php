<?php
session_start();

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}
require_once '../components/db_connect.php';

//id from the URL
if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE animalId = {$id}" ;
    $result = $connect->query($sql);
    $data = $result->fetch_assoc();
    if ($result->num_rows == 1) {
        $name = $data['anName'];
        $breed = $data['breed'];
        $location = $data['anLocation'];
        $description= $data['description'];
        $hobbies= $data['hobbies'];
        $age= $data['anAge'];
        $image = $data['anImage'];
        $size = $data['fk_sizeId'];

    } else {
        header("location: error.php");
    }
    $connect->close();
} else {
    header("location: error.php");
}  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CR11 Mario</title>
        <?php require_once '../components/boot.php'?>
        <link rel="stylesheet" href="../css/styles.css">
        <style type= "text/css">
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 70% ;
            }     
            .img-thumbnail{
                width: 70px !important;
                height: 70px !important;
            }    
        </style>
    </head>
    <body>
                    <!--Navbar-component-->
    <?php include_once "../components/navbar2.php";?>
        <fieldset class="shadow-css rounded">
            <legend class='h2 mb-3'>Delete request <img class='img-thumbnail rounded-circle' src='../pictures/<?php echo $image ?>' alt="<?php echo $name ?>"></legend>
            <h5>You have selected the data below:</h5>
            <table class="table w-75 mt-3">
                <tr>
                    <td><?php echo $name?></td>
                    <td><?php echo $location?></td>
                </tr>
            </table>

            <h3 class="mb-4">Do you really want to delete this animal?</h3>
            <form action ="actions/a_delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>" />
                <input type="hidden" name="image" value="<?php echo $image ?>" />
                <button class="btn btn-danger" type="submit">Yes, delete it!</button>
                <a href="admin_panel.php"><button class="btn btn-warning" type="button">No, go back!</button></a>
            </form>
        </fieldset>
        <!--Footer-component-->
        <?php include_once "../components/footer.php";?>
    </body>
</html>