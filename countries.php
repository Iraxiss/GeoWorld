<?php
require_once 'func/functions.php';

if (!empty($_GET['continent'])) {
    $continent = $_GET['continent'];
    $continentExist = verifContinent($continent);
    if ($continentExist) {
        $countries = getCountriesByContinent($continent);
    } else {
        header("Location: notFound.php");
        exit();
    }
} else {
    header("Location: notFound.php");
    exit();
}

?>
<?php require_once 'inc/header.php'; ?>
<main role="main" class="flex-shrink-0">
    <div class="container">
        <h4 class="text-center">Countries in <?php echo $continent ?> </h4>
        <div class="row">
            <div class="col-sm-6">
                <p></p><br>
                <div class="table-responsive">
                    <nav style="padding-top: 15px; padding-bottom: 12px;" class="navbar navbar-expand-md">
                        <input class="form-control col-md-6 offset-md-3" type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search...">
                    </nav>
                    <table id="myMenu" class="table table-borderless">
                        <tbody>
                        <?php foreach ($countries as $indice => $country): ?>
                            <tr align="center">
                                <td><a class="counttab" href="view.php?country=<?php echo $country->id; ?>"><?php echo $country->Name; ?></a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-6 "><br><br>
                <div class="col-sm-12">
                    <img src="img/cont.png" class="d-block w-100"><br>
                    <p></p>
                </div>
            </div>
        </div>
</main>
<?php require_once 'inc/footer.php'; ?>
