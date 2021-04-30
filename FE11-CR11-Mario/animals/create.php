<?php
session_start();
require_once '../components/db_connect.php';


if (isset($_SESSION['user']) != "" ) {
   header("Location: ../home.php");
   exit;
}

if (!isset($_SESSION['adm' ]) && !isset($_SESSION['user'])) {
   header("Location: ../index.php" );
    exit;
}

$size = "";
$result = mysqli_query($connect, "SELECT * FROM size");

while ($row = $result->fetch_array(MYSQLI_ASSOC)){
      $size .=
"<option value='{$row['sizeId']}'>{$row['size']}</option>";
   }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once '../components/boot.php'?>
        <title>CR11_Mario</title>
        <style>
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 60% ;
            }       
        </style>
    </head>
    <body>
        <fieldset>
            <legend class='h2'>Add Animal</legend>
            <form action="actions/a_create.php" method= "post" enctype="multipart/form-data">
                <table class='table'>
                    <tr>
                        <th>Name</th>
                        <td><input class='form-control' type="text" name="animal_name"  placeholder="Animal Name" /></td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td><input class='form-control' type="text" name="location"  placeholder="Location" /></td>
                    </tr>     
                    <tr>
                        <th>Breed</th>
                        <td><input class='form-control' type="text" name= "breed" placeholder="Breed" /></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><input class='form-control' type="text" name= "description" placeholder="Description" /></td>
                    </tr>
                    <tr>
                        <th>Hobbies</th>
                        <td><input class='form-control' type="text" name= "hobbies" placeholder="Hobbies" /></td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td><input class='form-control' type="number" name= "age" placeholder="Age" step="any" /></td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td><input class='form-control' type="file" name="image" /></td>
                    </tr>
                    <tr>
                        <th>Size</th>
                        <td><select  class="form-select"  name= "size"  aria-label= "Default select example">
                                <?php  echo $size; ?>
                                <!-- <option selected value ='none'>  Undefined </option> -->
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><button class='btn btn-success' type="submit">Add Animal</button></td>
                        <td><a href="index.php"><button class='btn btn-warning' type="button">Home</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </body>
</html>