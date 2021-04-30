<?php 
session_start();
require_once '../components/db_connect.php';

// if (isset($_SESSION['user']) != "") {
//     header("Location: ../home.php");
//     exit;
//  }
 
 if (! isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php" );
     exit;
 }

$sql = "SELECT * FROM animals WHERE anAge > 8";
$result = mysqli_query($connect ,$sql);
$tbody=''; //this variable will hold the body for the table
if(mysqli_num_rows($result)  > 0) {     
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){         
        $tbody .= "<tr>
            <td><img class='img-thumbnail' src='../pictures/" .$row['anImage']."'</td>
            <td>" .$row['anName']."</td>
            <td>" .$row['breed']."</td>
            <td>" .$row['anLocation']."</td>
            <td>" .$row['anAge']."</td>
            <td><a href='adopt.php?id=" .$row['animalId']."'><button class='btn btn-primary btn-sm' type='button'>Take me home</button></a></td>
            </tr>";
            // id in url is a parameter for get in delete or update
    };
} else {
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CR11 Mario</title>
        <?php require_once '../components/boot.php'?>
        <style type="text/css">
            .manageProduct {           
                margin: auto;
            }
            .img-thumbnail {
                width: 70px !important;
                height: 70px !important;
            }
            td {          
                text-align: left;
                vertical-align: middle;
            }
            tr {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="manageProduct w-75 mt-3">    
            <p class='h2'>All Animals</p>
            <table class='table table-striped'>
                <thead class='table-success'>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Breed</th>
                        <th>Location</th>
                        <th>Age</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?= $tbody;?>
                </tbody>
            </table>
        </div>
    </body>
</html>