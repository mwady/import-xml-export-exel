<?php
$url = "http://localhost/XML/";
?>
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav flex-column">
            <li class="nav-divider">
                Menu
            </li>
            <li class="nav-item" style="margin-bottom: 5px;">
                <a class="nav-link active" href="<?php echo $url; ?>dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item" style="margin-bottom: 5px;">
                <a class="nav-link active" href="<?php echo $url; ?>importxml.php">Import XML</a>
            </li>
        </ul>
    </div>
</nav>