<?php
session_start();
if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    header('Location: index.php');
    exit;
}

require_once 'classes/db.php';
require_once 'classes/conn.php';

if(isset($_POST['modify'])){

    $code = $_GET['id'];
    $id = $_POST['id'];
    $plaintiff_lastname = $_POST['plaintiff_lastname'];
    $plaintiff_firstname = $_POST['plaintiff_firstname'];
    $plaintiff_companyname = $_POST['plaintiff_companyname'];
    $plaintiff_street = $_POST['plaintiff_street'];
    $plaintiff_streetnumber = $_POST['plaintiff_streetnumber'];
    $plaintiff_postalcode = $_POST['plaintiff_postalcode'];
    $plaintiff_place = $_POST['plaintiff_place'];
    $plaintiff_countrycode = $_POST['plaintiff_countrycode'];
    $plaintiff_phonenumber = $_POST['plaintiff_phonenumber'];
    $plaintiff_faxnumber = $_POST['plaintiff_faxnumber'];
    $plaintiff_email = $_POST['plaintiff_email'];
    $plaintiff_belongstogroup = $_POST['plaintiff_belongstogroup'];

    $debtor_lastname = $_POST['debtor_lastname'];
    $debtor_firstname = $_POST['debtor_firstname'];
    $debtor_companyname = $_POST['debtor_companyname'];
    $debtor_street = $_POST['debtor_street'];
    $debtor_streetnumber = $_POST['debtor_streetnumber'];
    $debtor_postalcode = $_POST['debtor_postalcode'];
    $debtor_place = $_POST['debtor_place'];
    $debtor_countrycode = $_POST['debtor_countrycode'];
    $debtor_phonenumber = $_POST['debtor_phonenumber'];
    $debtor_email = $_POST['debtor_email'];
    $debtor_vatnr = $_POST['debtor_vatnr'];
    $debtor_debtornrpartner = $_POST['debtor_debtornrpartner'];

    if($id){
        $sth=$pdo->prepare("UPDATE data SET plaintiff_lastname = :plaintiff_lastname,plaintiff_firstname = :plaintiff_firstname,plaintiff_companyname = :plaintiff_companyname,plaintiff_street = :plaintiff_street,plaintiff_streetnumber = :plaintiff_streetnumber,plaintiff_postalcode = :plaintiff_postalcode,plaintiff_place = :plaintiff_place,plaintiff_countrycode = :plaintiff_countrycode,plaintiff_phonenumber = :plaintiff_phonenumber,plaintiff_faxnumber = :plaintiff_faxnumber,plaintiff_email = :plaintiff_email,plaintiff_belongstogroup = :plaintiff_belongstogroup,debtor_lastname = :debtor_lastname,debtor_firstname = :debtor_firstname,debtor_companyname = :debtor_companyname,debtor_street = :debtor_street,debtor_streetnumber = :debtor_streetnumber,debtor_postalcode = :debtor_postalcode,debtor_place = :debtor_place,debtor_countrycode = :debtor_countrycode,debtor_phonenumber = :debtor_phonenumber,debtor_email = :debtor_email,debtor_vatnr = :debtor_vatnr,debtor_debtornrpartner = :debtor_debtornrpartner WHERE id = ".$id); 

        $sth->bindParam(':plaintiff_lastname',$plaintiff_lastname);
        $sth->bindParam(':plaintiff_firstname',$plaintiff_firstname);
        $sth->bindParam(':plaintiff_companyname',$plaintiff_companyname);
        $sth->bindParam(':plaintiff_street',$plaintiff_street);
        $sth->bindParam(':plaintiff_streetnumber',$plaintiff_streetnumber);
        $sth->bindParam(':plaintiff_postalcode',$plaintiff_postalcode);
        $sth->bindParam(':plaintiff_place',$plaintiff_place);
        $sth->bindParam(':plaintiff_countrycode',$plaintiff_countrycode);
        $sth->bindParam(':plaintiff_phonenumber',$plaintiff_phonenumber);
        $sth->bindParam(':plaintiff_faxnumber',$plaintiff_faxnumber);
        $sth->bindParam(':plaintiff_email',$plaintiff_email);
        $sth->bindParam(':plaintiff_belongstogroup',$plaintiff_belongstogroup);

        $sth->bindParam(':debtor_lastname',$debtor_lastname);
        $sth->bindParam(':debtor_firstname',$debtor_firstname);
        $sth->bindParam(':debtor_companyname',$debtor_companyname);
        $sth->bindParam(':debtor_street',$debtor_street);
        $sth->bindParam(':debtor_streetnumber',$debtor_streetnumber);
        $sth->bindParam(':debtor_postalcode',$debtor_postalcode);
        $sth->bindParam(':debtor_place',$debtor_place);
        $sth->bindParam(':debtor_countrycode',$debtor_countrycode);
        $sth->bindParam(':debtor_phonenumber',$debtor_phonenumber);
        $sth->bindParam(':debtor_email',$debtor_email);
        $sth->bindParam(':debtor_vatnr',$debtor_vatnr);
        $sth->bindParam(':debtor_debtornrpartner',$debtor_debtornrpartner);
        $sth->execute(); 


        $file = "upload/xml/".$_GET['id'].".xml";
        $xml = simplexml_load_file($file);
        foreach ($xml->xpath('//NewCase/plaintiff') as $desc) {
            $desc->lastname = $plaintiff_lastname;
            $desc->firstname = $plaintiff_firstname;
            $desc->companyname = $plaintiff_companyname;
            $desc->street = $plaintiff_street;
            $desc->streetnumber = $plaintiff_streetnumber;
            $desc->postalcode = $plaintiff_postalcode;
            $desc->place = $plaintiff_place;
            $desc->countrycode = $plaintiff_countrycode;
            $desc->phonenumber = $plaintiff_phonenumber;
            $desc->faxnumber = $plaintiff_faxnumber;
            $desc->email = $plaintiff_email;
            $desc->belongstogroup = $plaintiff_belongstogroup;
        }
        foreach ($xml->xpath('//NewCase/debtor') as $desc) {
            $desc->lastname = $debtor_lastname;
            $desc->firstname = $debtor_firstname;
            $desc->companyname = $debtor_companyname;
            $desc->street = $debtor_street;
            $desc->streetnumber = $debtor_streetnumber;
            $desc->postalcode = $debtor_postalcode;
            $desc->place = $debtor_place;
            $desc->countrycode = $debtor_countrycode;
            $desc->phonenumber = $debtor_phonenumber;
            $desc->email = $debtor_email;
            $desc->vatnr = $debtor_vatnr;
            $desc->debtornrpartner = $debtor_debtornrpartner;
        }
        file_put_contents($file, $xml->asXML());


        $file = "upload/xml/".$_GET['id'].".xml";
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }

        header("Refresh:0");

    }
    

}

$stmt = $pdo->query("SELECT * FROM data WHERE code = ".$_REQUEST['id']);
$row = $stmt->fetch();


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <style>
    input{
        margin-bottom: 10px;
    }
    </style>
</head>
<body>
    <div class="dashboard-main-wrapper">
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
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">XML</h2>
                            </div>
                        </div>
                    </div>
                    <div class="ecommerce-widget">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Traitement XML</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive" style="padding:20px;">
                                            <form method="POST">
                                                <h2>Plaintiff</h2>
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Last name</label>
                                                        <input type="text" class="form-control" name="plaintiff_lastname" value="<?php echo $row['plaintiff_lastname']; ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>First name</label>
                                                        <input type="text" class="form-control" name="plaintiff_firstname" value="<?php echo $row['plaintiff_firstname']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Company name</label>
                                                        <input type="text" class="form-control" name="plaintiff_companyname" value="<?php echo $row['plaintiff_companyname']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Street</label>
                                                        <input type="text" class="form-control" name="plaintiff_street" value="<?php echo $row['plaintiff_street']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Street number</label>
                                                        <input type="text" class="form-control" name="plaintiff_streetnumber" value="<?php echo $row['plaintiff_streetnumber']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Postal code</label>
                                                        <input type="text" class="form-control" name="plaintiff_postalcode" value="<?php echo $row['plaintiff_postalcode']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Place</label>
                                                        <input type="text" class="form-control" name="plaintiff_place" value="<?php echo $row['plaintiff_place']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Country code</label>
                                                        <input type="text" class="form-control" name="plaintiff_countrycode" value="<?php echo $row['plaintiff_countrycode']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Phone number</label>
                                                        <input type="text" class="form-control" name="plaintiff_phonenumber" value="<?php echo $row['plaintiff_phonenumber']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Fax number</label>
                                                        <input type="text" class="form-control" name="plaintiff_faxnumber" value="<?php echo $row['plaintiff_faxnumber']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" name="plaintiff_email" value="<?php echo $row['plaintiff_email']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Belongs to group</label>
                                                        <input type="text" class="form-control" name="plaintiff_belongstogroup" value="<?php echo $row['plaintiff_belongstogroup']; ?>">
                                                    </div>
                                                </div>
                                                <br>
                                                <h2>Debtor</h2>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Last name</label>
                                                        <input type="text" class="form-control" name="debtor_lastname" value="<?php echo $row['debtor_lastname']; ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>First name</label>
                                                        <input type="text" class="form-control" name="debtor_firstname" value="<?php echo $row['debtor_firstname']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Company name</label>
                                                        <input type="text" class="form-control" name="debtor_companyname" value="<?php echo $row['debtor_companyname']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Street</label>
                                                        <input type="text" class="form-control" name="debtor_street" value="<?php echo $row['debtor_street']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Street number</label>
                                                        <input type="text" class="form-control" name="debtor_streetnumber" value="<?php echo $row['debtor_streetnumber']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Postal code</label>
                                                        <input type="text" class="form-control" name="debtor_postalcode" value="<?php echo $row['debtor_postalcode']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Place</label>
                                                        <input type="text" class="form-control" name="debtor_place" value="<?php echo $row['debtor_place']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Country code</label>
                                                        <input type="text" class="form-control" name="debtor_countrycode" value="<?php echo $row['debtor_countrycode']; ?>">
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" name="debtor_email" value="<?php echo $row['debtor_email']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Vatnr</label>
                                                        <input type="text" class="form-control" name="debtor_vatnr" value="<?php echo $row['debtor_vatnr']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Debtornrpartner</label>
                                                        <input type="text" class="form-control" name="debtor_debtornrpartner" value="<?php echo $row['debtor_debtornrpartner']; ?>">
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <label>Phone number</label>
                                                        <input type="text" class="form-control" name="debtor_phonenumber" value="<?php echo $row['debtor_phonenumber']; ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="submit" name="modify" value="Modifier et Exporter XML" class="btn btn-warning">
                                                    </div>
                                                </div>
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