<?php
session_start();

// if (isset($_SESSION[ '']) != "") {
//    header("Location: ../../home.php");
//    exit;
// }

if  (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
   header("Location: ../../index.php" );
    exit;
}


require_once '../../components/db_connect.php' ;
// require_once '../../components/file_upload.php';



if ($_POST['animalId']) {

    if (isset($_SESSION['user'])) {
        $uid = $_SESSION['user'];
     } else {
         $uid = $_SESSION['adm'];
     }
    $id = $_POST['animalId'];
    $status = 'adopted';
    
    // echo $uid;
    // var_dump($_SESSION);
    $sql = "INSERT INTO petadoption (fk_animalId, fk_userId, status) VALUES ($id, $uid, $status )";
    $adopt_create = mysqli_query($connect, $sql);
    // echo $adopt_create;
    $adopting = mysqli_query($connect ,"SELECT  animals.anImage, animals.anName, animals.anLocation, animals.anAge FROM petadoption JOIN animals ON fk_animalId = animals.animalId");
    // echo $adopting;
    $abody=''; // variable for the table
    
    if(mysqli_num_rows($adopting)  > 0) {     
        while($row = mysqli_fetch_array($adopting, MYSQLI_ASSOC)){         
            $abody .= "<tr>
                <td><img class='img-thumbnail' src='../../pictures/".$row['anImage']."'</td>
                <td>" .$row['anName']."</td>
                <td>" .$row['anLocation']."</td>                
                <td>" .$row['anAge']."</td>
            </tr>";
        };
    } else  {
        $abody = "<tr><td colspan='5'><center>No Adoptions</center></td></tr>";
    }
    
}
    $connect->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../../components/bootcss.php'?>
    <!--This will force the CSS to reload.-->
    <link rel="stylesheet" href="../../css/styles.css?v=<?php echo time(); ?>">
    <title>CR11 Mario</title>
</head>
<body>
    <!--Navbar-component-->
    <?php include_once "../../components/navbar3.php";?>
    <div class="container">
    <p class='h2'>All adopted Pets</p>
    <a href='../home.php'><button class='btn btn-success btn-sm' type='button'>Back to DashBoard</button></a><br><br> 
    <table class='table table-striped shadow-css'>
        <thead class='table-style'>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Location</th>             
                <th>Age</th>
            </tr>
        </thead>
        <tbody class='bg-light'>
            <?php echo $abody;?>
        </tbody>
    </table>
    </div>
    <!--Footer-component-->
    <?php include_once "../../components/footer_sticky.php";?>
    <!--Bootstrap-JS-component-->
    <?php include_once "../../components/boot_js.php";?>
</body>
</html>