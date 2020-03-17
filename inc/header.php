<?php require_once 'func/functions.php'; ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <link rel="icon" href="img/logo.ico" />
  <title>GeoWorld</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

<header>
    <nav class="geonav navbar navbar-expand-md navbar-dark">
        <table>
            <tr>
                <td><a class="geoworld navbar-brand" style="color: white; font-weight: 600; opacity: 0.9;" href="index.php">GeoWorld</a></td>
                <?php if(adminLogged()): ?>
                    <td><p style="line-height: 0.5; font-size: 14px; color: #fafafa;"><a style="color: white; font-weight: 600; opacity: 0.6;" href="admin.php">Administration</a></p></td>
                <?php elseif (teacherLogged()): ?>
                  <td><p style="line-height: 0.5; font-size: 14px; color: #fafafa;"><a style="color: white; font-weight: 600; opacity: 0.6;">Teacher's Area</a></p></td>
                <?php endif; ?>
            </tr>
        </table>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a style="color: white; font-weight: 500; opacity: 0.6;" class="nav-link text-center" href="" data-toggle="modal" data-target="#continentsModalCenter">Continents</a>
                </li>
                <li class="nav-item">
                    <a style="color: white; font-weight: 500; opacity: 0.6;" class="nav-link text-center" href="sqlQuery.php" data-toggle="modal" data-target="#sqlModalCenter">SQL</a>
                </li>
                <?php if(!adminLogged() && !teacherLogged()): ?>
                    <li class="nav-item">
                        <a style="color: white; font-weight: 500; opacity: 0.6;" class="nav-link text-center" href="teacherLogin.php">Teacher's Area</a>
                    </li>
                <?php endif; ?>
                <?php if((adminLogged()) || (teacherLogged())): ?>
                    <li class="nav-item">
                        <a style="color: white; font-weight: 500; opacity: 0.6;" class="nav-link text-center" href="logout.php">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>

<!-- Modals -->

<div class="modal fade" id="continentsModalCenter" tabindex="-1" role="dialog" aria-labelledby="continentsModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="geonav navbar modal-header ">
                <h5 class="modal-title" id="continentsModalLongTitle">Continents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $listesContinents = getContinents();
                foreach($listesContinents as $indice=>$continents):
                    ?>
                    <a class="modcon dropdown-item" href="countries.php?continent=<?php echo $continents->continent; ?>"><?php echo $continents->continent; ?></a>
                <?php endforeach; ?>
            </div>
            <div class="modal-footer">
                <p> <span style="font-size: 12px;" class="text-muted">GeoWorld &copy; 2020</span> </p>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="sqlModalCenter" tabindex="-1" role="dialog" aria-labelledby="sqlModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="geonav navbar modal-header ">
                <h5 class="modal-title" id="sqlModalLongTitle">Structured Query Language</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="lead text-center">By continuing you will have access to a relational schema of a part of the geoworld database !</p>
                <p class="lead text-center">Only read queries are allowed "SELECT"</p>
                <h4 class="text-center" style="padding-top: 10px;"><a href="sqlQuery.php" class="contbtn" >Access</a></h4><p></p>
            </div>
            <div class="modal-footer">
                <p> <span style="font-size: 12px;" class="text-muted">GeoWorld &copy; 2020</span> </p>
            </div>
        </div>
    </div>
</div>




