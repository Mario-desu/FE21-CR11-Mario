<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Error</title>
        <?php require_once '../components/bootcss.php'?>    
        <!--This will force the CSS to reload.-->
        <link rel="stylesheet" href="../css/styles.css?v=<?php echo time(); ?>">
    </head>
    <body>
                    <!--Navbar-component-->
    <?php include_once "../components/navbar2.php";?>
        <div class="container">  
            <div class="mt-3 mb-3">
                <h1>Invalid Request</h1>
            </div>
            <div class="alert alert-warning shadow-css rounded" role="alert">
                <p>You've made an invalid request. Please <a href="index.php" class="alert-link">go back</a> to index and try again.</p>
            </div>
        </div>
        <!--Footer-component-->
        <?php include_once "../components/footer_sticky.php";?>
        <!--Bootstrap-JS-component-->
        <?php include_once "../components/boot_js.php";?>
</body>
</html>