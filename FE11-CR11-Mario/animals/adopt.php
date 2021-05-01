<?php
session_start();

// if (isset($_SESSION[ 'user']) != "") {
//    header("Location: ../home.php");
//    exit;
// }

if (! isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
   header("Location: ../index.php" );
    exit;
}

require_once '../components/db_connect.php' ;

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE animalId = {$id}";
    // echo $sql;
    $result = $connect->query($sql);
    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        $name = $data['anName'];
        $breed = $data['breed'];
        $location = $data['anLocation'];
        $description = $data['description'];
        $hobbies = $data['hobbies'];
        $age = $data['anAge'];
        $image = $data['anImage'];
        $size = $data['fk_sizeId'];

        $resultSize = mysqli_query($connect, "SELECT * FROM size");
        $sizeList = "";
        if(mysqli_num_rows($resultSize) > 0){
           while ($row = $resultSize->fetch_array(MYSQLI_ASSOC)){
               if($row['sizeId'] == $size){
                   $sizeList .= "{$row['size']}";  
               }
            }                
           }else{
           $agencyList = "<li>There are no agencies registered</li>";
       }

    } else {
        header("location: error.php");
    }
    $connect->close();
} else {
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>CR11 Mario</title>
        <?php require_once '../components/boot.php'?>
        <link rel="stylesheet" href="../css/styles.css">
        <style type= "text/css">
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 60% ;
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
            <legend class='h2'>Adopt <?php echo $name ?></legend>
            <form action="actions/a_adopt.php"  method="post" enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <th><img class='img-fluid' src='../pictures/<?php echo $image ?>' alt="<?php echo $name ?>"></th>
                        <td></td>
                    </tr>                
                    <tr>
                        <th>Name</th>
                        <td><?php echo $name ?></td>
                    </tr>
                    <tr>
                        <th>Breed</th>
                        <td><?php echo $breed ?></td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td><?php echo $location ?></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><?php echo $description ?></td>
                    </tr>
                    <tr>
                        <th>Hobbies</th>
                        <td><?php echo $hobbies ?></td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td><?php echo $age ?></td>
                    </tr>
                    <tr>
                    <tr>
                        <th>Size</th>
                        <td><?php echo $sizeList ?></td>
                    </tr>

                    <tr>
                        <input type= "hidden" name= "animalId" value= "<?php echo $data['animalId'] ?>" />
                        <input type= "hidden" name= "image" value= "<?php echo $data['anImage'] ?>" />
                        <td><button class="btn btn-success" type= "submit">Adopt <?php echo $name ?></button></td>
                        <td><a href= "home.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
        <!--Footer-component-->
        <?php include_once "../components/footer.php";?>
    </body>
</html>