<?php



session_start();







if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){



    //User not logged in. Redirect them back to the login.php page.



    header('Location: index.php');



    exit;



}







require_once 'classes/db.php';



require_once 'classes/conn.php';


if(isset($_POST['ok'])){

    // $xmldata = simplexml_load_file("SekundiCases.xml") or die("Failed to load");
    // $xmldata = simplexml_load_file($_FILES['importxml']['tmp_name']); 

    // print_r($xmldata);
    $folder ="upload/xml/"; 
    $image = $_FILES['image']['name']; 

    $temp = explode(".", $_FILES["image"]["name"]);
    $code = round(microtime(true));
    $newfilename = $code . '.' . end($temp);
    
    $target_file=$folder.basename($_FILES["image"]["name"]);
    $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
    $allowed=array('xml');
    $filename=$_FILES['image']['name'];
    $ext=pathinfo($filename, PATHINFO_EXTENSION);

    if(!in_array($ext,$allowed) ) { 
        die("Sorry, only XML files are allowed.");
    }
    else{

        move_uploaded_file($_FILES["image"]["tmp_name"], "upload/xml/" . $newfilename);
        
    }

    header('Location: traitxml.php?id='.$code);

    die();

}




?>



<!doctype html>



<html lang="en">



 



<head>



    <!-- Required meta tags -->



    <meta charset="utf-8">



    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Bootstrap CSS -->



    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">



    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">



    <link rel="stylesheet" href="assets/libs/css/style.css">



    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">



    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">



    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">



    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">



    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">



    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">



    <title>Admin</title>



</head>







<body>



    <!-- ============================================================== -->



    <!-- main wrapper -->



    <!-- ============================================================== -->



    <div class="dashboard-main-wrapper">



        <!-- ============================================================== -->



        <!-- navbar -->



        <!-- ============================================================== -->



        <div class="dashboard-header">



            <nav class="navbar navbar-expand-lg bg-white fixed-top">



                <a class="navbar-brand" href="index.html">Creches.ma</a>



                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">



                    <span class="navbar-toggler-icon"></span>



                </button>



                <div class="collapse navbar-collapse " id="navbarSupportedContent">



                    <ul class="navbar-nav ml-auto navbar-right-top">



                        <li class="nav-item dropdown nav-user">



                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>



                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">



                                <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>



                            </div>



                        </li>



                    </ul>



                </div>



            </nav>



        </div>



        <div class="nav-left-sidebar sidebar-dark">



            <div class="menu-list">



                <?php require_once 'inc/menu.php'; ?>



            </div>



        </div>



        <div class="dashboard-wrapper">



            <div class="dashboard-ecommerce">



                <div class="container-fluid dashboard-content ">



                    <!-- ============================================================== -->



                    <!-- pageheader  -->



                    <!-- ============================================================== -->



                    <div class="row">



                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">



                            <div class="page-header">



                                <h2 class="pageheader-title">Import XML</h2>



                            </div>



                        </div>



                    </div>



                    <!-- ============================================================== -->



                    <!-- end pageheader  -->



                    <!-- ============================================================== -->



                    <div class="ecommerce-widget">



                        <div class="row">



                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">



                                <div class="card">



                                    <h5 class="card-header">Import XML</h5>



                                    <div class="card-body p-0">



                                        <div class="table-responsive" style="padding:20px;">



                                            <form method="POST" enctype="multipart/form-data">
                                                <input type="file" name="image" class="form-control">
                                                <input type="submit" name="ok" value="Importer" style="margin-top: 10px;" class="btn btn-success" /> 
                                            </form>



                                        </div>



                                    </div>



                                </div>



                            </div>



                        </div>







                        



                    </div>



                </div>



            </div>



        </div>



    </div>







    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>



    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>



    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>



    <script src="assets/libs/js/main-js.js"></script>



    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>



    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>



    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>



    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>



    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>



    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>



    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>



    <script src="assets/libs/js/dashboard-ecommerce.js"></script>



</body>



 



</html>