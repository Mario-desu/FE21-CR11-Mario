<?php
session_start();

// if (isset($_SESSION[ 'user']) != "") {
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
    $id = $_POST['animalId'];
    $uid = $_SESSION['adm'];
    // echo $uid;
    // var_dump($_SESSION);
    $sql = "INSERT INTO petadoption (fk_animalId, fk_userId) VALUES ($id, $uid)";
    $adopt_create = mysqli_query($connect, $sql);
    echo $adopt_create;
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
    <?php require_once '../../components/boot.php'?>
    <title>CR11 Mario</title>
</head>
<body>
    <div class="container">
    <a href='../booking_dash.php'><button class='btn btn-success btn-sm' type='button'>Back to DashBoard</button></a> 
    <table class='table table-striped'>
        <thead class='table-success'>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Location</th>             
                <th>Age</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $abody;?>
        </tbody>
    </table>
    </div>
</body>
</html>