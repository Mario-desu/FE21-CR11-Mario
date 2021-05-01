<?php
session_start();

if (isset($_SESSION[ 'user']) != "") {
   header("Location: ../home.php");
   exit;
}

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
        $description= $data['description'];
        $hobbies= $data['hobbies'];
        $age= $data['anAge'];
        $image = $data['anImage'];
        $size = $data['fk_sizeId'];
        $status = $data['status'];

        $resultSize = mysqli_query($connect, "SELECT * FROM size");
        $sizeList = "";
        if(mysqli_num_rows($resultSize) > 0){
           while ($row = $resultSize->fetch_array(MYSQLI_ASSOC)){
               if($row['sizeId'] == $size){
                   $sizeList .= "<option selected value='{$row['sizeId']}'>{$row['size']}</option>";  
               }else {
                   $sizeList .= "<option value='{$row['sizeId']}'>{$row['size']}</option>";
               }}                
           }else{
           $agencyList = "<li>Size is not known</li>";
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
            <legend class='h2'>Edit <?php echo $name ?>'s Data <img class='img-thumbnail rounded-circle' src='../pictures/<?php echo $image ?>' alt="<?php echo $name ?>"></legend>
            <form action="actions/a_update.php"  method="post" enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <td><input class="form-control" type="text"  name="animal_name" placeholder ="Animal Name" value="<?php echo $name ?>"  /></td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td><input class="form-control" type="text"  name="location" placeholder ="Location" value="<?php echo $location ?>"  /></td>
                    </tr>
                    <tr>
                        <th>Breed</th>
                        <td><input class="form-control" type="text"  name="breed" placeholder ="Breed" value="<?php echo $breed ?>"  /></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><input class="form-control" type="text"  name="description" placeholder ="Description" value="<?php echo $description ?>"  /></td>
                    </tr>
                    <tr>
                        <th>Hobbies</th>
                        <td><input class="form-control" type="text"  name="hobbies" placeholder ="Hobbies" value="<?php echo $hobbies ?>"  /></td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td><input class="form-control" type= "number" name="age" step="any"  placeholder="Age" value ="<?php echo $age ?>" /></td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td><input class="form-control" type="file" name= "image" /></td>
                    </tr>
                    <tr>
                        <th>Size</th>
                        <td>
                        <select select class = "form-select"   name = "size"   aria-label = "Default select example" >
                            <?php   echo  $sizeList; ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><input class="form-control" type="text"  name="status" placeholder ="Status" value="<?php echo $status ?>"  /></td>
                    </tr>
                    
                    
                    <tr>
                        <input type= "hidden" name= "animalId" value= "<?php echo $data['animalId'] ?>" />
                        <input type= "hidden" name= "image" value= "<?php echo $data['anImage'] ?>" />
                        <td><button class="btn btn-success" type= "submit">Save Changes</button></td>
                        <td><a href= "admin_panel.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
        <!--Footer-component-->
        <?php include_once "../components/footer.php";?>
    </body>
</html>