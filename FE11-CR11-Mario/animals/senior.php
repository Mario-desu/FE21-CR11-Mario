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
        <?php require_once '../components/bootcss.php'?>
        <!--This will force the CSS to reload.-->
        <link rel="stylesheet" href="../css/styles.css?v=<?php echo time(); ?>">
        <style type="text/css">
            .manageProduct {           
                margin: auto;
            }
            .img-thumbnail {
                height: 70px !important;
            }
            td {          
                text-align: center;
                vertical-align: middle;
            }
            tr {
                text-align: center;
            }
        </style>
    </head>
    <body>
                    <!--Navbar-component-->
    <?php include_once "../components/navbar2.php";?>
        <div class="manageProduct w-75 mt-3">    
            <p class='h2'>Only Seniors</p>
            <a href='home.php'><button class='btn btn-info btn-sm' type='button'>All pets</button></a>
            <a href='available.php'><button class='btn btn-info btn-sm' type='button'>Available Pets</button></a></p>
            <p><a href='admin_panel.php'>Administration</a></p>
            <table class='table table-striped shadow-css'>
                <thead class='table-style'>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Breed</th>
                        <th>Location</th>
                        <th>Age</th>
                        <th></th>
                    </tr>
                </thead class='table-style'>
                <tbody class='bg-light'>
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