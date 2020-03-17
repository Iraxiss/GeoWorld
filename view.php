<?php
require_once 'func/functions.php';

if(!empty($_GET['country'])){
    $idCountry = $_GET['country'];
    if(countryExist($idCountry)) {
        $getCountryInfo = getCountryInfo($idCountry);
        // var_dump($getCountryInfo);

        $getCapital = getCapital($idCountry);
        // var_dump($getCapital);

        $getOfficialLanguage = getOfficialLanguage($idCountry);
        // var_dump($getOfficialLanguage);

        $getLanguages = getLanguages($idCountry);
        // var_dump($getLanguages);

        $getCityInfo = getCityInfo($idCountry);
        //var_dump($getCityInfo);
    }else{
        header("Location: notFound.php");
    }
}else{
    header("Location: notFound.php");
}

?>
<?php require_once 'inc/header.php'; ?>
<main role="main" class="flex-shrink-0">
    <div class="container">
        <table align="center">
            <tr>
                <td><h5 class="text-center" ><?php echo $getCountryInfo->Name; ?>&nbsp; <img style="border: 1px solid black;" src="img/flag/<?php echo $getCountryInfo->Name; ?>.png" height="27" width="42"><?php if(adminLogged() || teacherLogged()): ?>&nbsp; <a class="btn btn-outline-danger" href="update.php?country=<?php echo $getCountryInfo->id; ?>">UPDATE</a><?php endif; ?></h5></td>
            </tr>
        </table>
        <div class="row">
            <div class="col-sm-6">
                <br><br><p></p>
                <table>
                    <tr>
                        <td><h6 style="font-weight: bold;">Region : <span style="font-weight: normal;"><?php echo $getCountryInfo->Region; ?></span></h6></td>
                    </tr>
                    <tr>
                        <td><h6 style="font-weight: bold;">Surface Area : <span style="font-weight: normal;"><?php echo $getCountryInfo->SurfaceArea; ?> km²</span></h6></td>
                    </tr>
                    </tr>
                    <tr>
                        <td><h6 style="font-weight: bold;">Population : <span style="font-weight: normal;"><?php echo $getCountryInfo->Population; ?> M</span></h6></td>
                    </tr>
                    <tr>
                        <td><h6 style="font-weight: bold;">Government Form : <span style="font-weight: normal;"><?php echo $getCountryInfo->GovernmentForm; ?></span></h6></td>
                    </tr>
                    <tr>
                        <td><h6 style="font-weight: bold;">Capital : <span style="font-weight: normal;"><?php echo (!empty($getCapital->Name)) ? $getCapital->Name : ""; ?></span></h6></td>
                    </tr>
                    <tr>
                        <td><h6 style="font-weight: bold;">Official language : <span style="font-weight: normal;">
                            <?php foreach ($getOfficialLanguage as $Olang){ echo (!empty($Olang->Name)) ? "$Olang->Name " : ""; } ?>
                        </span></h6></td>
                    </tr>
                    <tr>
                        <td><h6 style="font-weight: bold;">Head Of State : <span style="font-weight: normal;"><?php echo $getCountryInfo->HeadOfState; ?></span></h6></td>
                    </tr>
                </table>
            </div>

            <div class="col-sm-6 "><br><p></p>
                <div class="col-sm-12">
                    <img src="img/pays.png" class="d-block w-100">
                </div>
            </div>

            <div style="margin:auto; padding-top: 60px; width: 70%; height: 400px;" class="text-center" id="piechart"></div>


            <div class="table-responsive" style="width: 85%; margin: auto;">
                <br><p></p>
                <h6 style="font-weight: bold;"> <a href="https://earth.google.com/web/@-34.60960027,-100.74439882,-13267.34577873a,29549777.35057354d,35y,0h,0t,0r" target="_blank">
                        <img src="img/logo.png" width="30" height="30" >
                    </a> Cities :</h6><p></p>
                <table class="table text-center table-bordered table-sm">
                    <thead class="geonav">
                    <tr>
                        <th>Name</th>
                        <th>Population</th>
                    </tr>
                    </thead>
                    <tr>
                        <?php foreach($getCityInfo as $indice => $city): ?>
                    <tr>
                        <td><?php echo $city->Name; ?></td>
                        <td><?php echo $city->Population; ?> M</td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</main>
<?php require_once 'inc/footer.php'; ?>    