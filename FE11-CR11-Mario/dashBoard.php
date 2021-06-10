<?php
session_start();
require_once 'components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
//if session user exist it shouldn't access dashboard.php
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}



$id = $_SESSION['adm'];


$status = 'adm';
$sqlSelect = "SELECT * FROM user WHERE status != ? ";
$stmt = $connect->prepare($sqlSelect);
$stmt->bind_param("s", $status);
$work = $stmt->execute();
$result = $stmt->get_result();
//this variable will hold the body for the table
$tbody = ''; 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td><img class='img-thumbnail rounded-circle' src='pictures/" . $row['image'] . "' alt=" . $row['f_name'] . "></td>
            <td>" . $row['f_name'] . " " . $row['l_name'] . "</td>
            <td>" . $row['date_of_birth'] . "</td>
            <td>" . $row['email'] . "</td>
            <td><a href='update.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
            <a href='delete.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
         </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adm-DashBoard</title>
        <?php require_once 'components/bootcss.php'?>
        <!--This will force the CSS to reload.-->
        <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
        <style type="text/css">        
            .img-thumbnail{

                height: 70px !important;
            }
            td{
                text-align: center;
                vertical-align: middle;
            }
            tr{
                text-align: center;
            }
            .userImage{
                width: 100px;
                height: auto;
            }

            /*img will be hidden when screen smaller*/
            @media screen and (max-width:992px) { 
                .img-thumbnail {visibility:hidden;}
            
            
             }
        </style>
    </head>
    <body>
            <!--Navbar-component-->
    <?php include_once "components/navbar1.php";?>
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img class="userImage img-fluid" src="pictures/admavatar.png" alt="Adm avatar">
                    <p class="">Administrator</p>

                    <a href="animals/admin_panel.php">Animals</a><br>
                    <a href="logout.php?logout">Sign Out</a>
                </div>
                <div class="col-8 mt-2 ms-4">
                    <p class='h2'>Users</p>
                    <table class='table table-striped shadow-css'>
                        <thead class='table-style'>
                            <tr>
                                <th class="img-user"></th>
                                <th>Name</th>
                                <th>Date of birth</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class='bg-light'>
                            <?=$tbody?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <!--Footer-component-->
    <?php include_once "components/footer_sticky.php";?>
    <!--Bootstrap-JS-component-->
    <?php include_once "components/boot_js.php";?>
    </body>
</html>