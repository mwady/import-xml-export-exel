<?php
session_start();
if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    header('Location: index.php');
    exit;
}
require_once 'classes/db.php';
require_once 'classes/conn.php';

if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $stmt = $pdo->query("SELECT * FROM data WHERE id = ".$id);
    $row = $stmt->fetch();

    if ($id) {
        $sth=$pdo->prepare("DELETE FROM data WHERE id = :id"); 
        $sth->bindParam(':id',$id);
        $sth->execute(); 
        unlink("upload/xml/".$row["code"].".xml");
    }

}

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Admin</title>
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
                                <h2 class="pageheader-title">Dashboard</h2>
                            </div>
                        </div>
                    </div>
                    <div class="ecommerce-widget">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Dashboard</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive" style="padding:20px;">
                                            <table id="tablexml" class="display" width="100%" data-page-length="25">
                                                <thead>
                                                    <tr>
                                                        <th>Name[plaintiff]</th>
                                                        <th>Company[plaintiff]</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $stmt = $pdo->query("SELECT * FROM data ORDER BY id DESC");
                                                    while ($row = $stmt->fetch()) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['plaintiff_lastname']." ".$row['plaintiff_firstname']; ?></td>
                                                        <td><?php echo $row['plaintiff_companyname']; ?></td>
                                                        <td>
                                                            <a href="modifxml.php?id=<?php echo $row['code']; ?>" class="btn btn-warning">Modifier</a>
                                                            <form method="POST" style="display:inline-block;">
                                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                <input type="submit" name="delete" value="Supprimer" class="btn btn-danger" onclick="return confirm('Are you sure you want to Remove?');">
                                                            </form>
                                                            <form method="POST" action="export.php" style="display:inline-block;">
                                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                <input type="submit" name="exportexel" value="EXEL" class="btn btn-success">
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
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
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#tablexml").DataTable();
        });
    </script>
</body>
</html>