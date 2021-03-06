<?php 
session_start();
require_once '../components/db_connect.php';

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
 }
 
 if (! isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php" );
     exit;
 }

$sql = "SELECT * FROM animals";
$result = mysqli_query($connect ,$sql);
$tbody=''; //this variable will hold the body for the table
if(mysqli_num_rows($result)  > 0) {     
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){         
        $tbody .= "<tr>
            <td><img class='img-thumbnail' src='../pictures/" .$row['anImage']."'</td>
            <td>" .$row['anName']."</td>
            <td>" .$row['anLocation']."</td>
            <td>" .$row['breed']."</td>
            <td>" .$row['anAge']."</td>
            <td>" .$row['status']."</td>
            <td><a href='update.php?id=" .$row['animalId']."'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
            <a href='delete.php?id=" .$row['animalId']."'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
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
        <?php require_once '../components/bootcss.php'?>
        <!--This will force the CSS to reload.-->
        <link rel="stylesheet" href="../css/styles.css?v=<?php echo time(); ?>">
        <!-- <style type="text/css">
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
        </style> -->
    </head>
    <body>
                    <!--Navbar-component-->
    <?php include_once "../components/navbar2.php";?>
        <div class="manageProduct w-75 mt-3">    
            <div class='mb-3'>
                <a href= "create.php"><button class='btn btn-primary'type="button" >Add Animal</button></a>
            </div>
            <p class='h2'>Animals</p>
            <table class='table table-striped shadow-css'>
                <thead class='table-style'>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Breed</th>
                        <th>Age</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="bg-light">
                    <?= $tbody;?>
                </tbody>
            </table>
        </div>
        <!--Footer-component-->
        <?php include_once "../components/footer.php";?>
            <!--Bootstrap-JS-component-->
            <?php include_once "../components/boot_js.php";?>
    </body>
</html>