<?php
require_once 'func/functions.php';

if(isset($_SESSION['teacher'])){  $iduser = $_SESSION['teacher']; }
if(isset($_SESSION['teacher'])){  $iduser = $_SESSION['teacher']; }

    if(isset($_SESSION['admin']) || isset($_SESSION['teacher'])){
        if(!empty($_GET['country'])){
            $idCountry = $_GET['country'];
            if(countryExist($idCountry)) {
                $getCountryInfo = getCountryInfo($idCountry);
                // var_dump($getCountryInfo);

                // Update
                if(isset($_POST["validate"])){
                    $surfaceArea = trim($_POST["surfaceArea"]);
                    $population = trim($_POST["population"]);
                    $lifeExpectancy = trim($_POST["lifeExpectancy"]);
                    $gnp = trim($_POST["gnp"]);
                    $gnpold = trim($_POST["gnpold"]);
                    $headOfState = trim($_POST["headOfState"]);


                        updateInfo($surfaceArea, $population, $lifeExpectancy, $gnp, $gnpold, $headOfState, $idCountry);
                        header("Location: update.php?country=$idCountry");
                        exit();


                }

                // Message
                if(isset($_POST['send'])){
                    $message = trim($_POST['message']);
                    if (!empty($_POST['message'])) {
                        sendMessage($iduser,$message);
                        $error = "Message sent !";
                    }else{
                        $error = "Make sure to fill in the fields.";
                    }
                }

            }else{
                header("Location: notFound.php");
            }
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
                <td><h5 class="text-center" ><?php echo $getCountryInfo->Name; ?>&nbsp; <?php if(adminLogged() || teacherLogged()): ?><a href="update.php?page=<?php echo $getCountryInfo->Name; ?>"></a><?php endif; ?><img style="border: 1px solid black;" src="img/flag/<?php echo $getCountryInfo->Name; ?>.png" height="27" width="42"><?php if(adminLogged() || teacherLogged()): ?>&nbsp; <a href="" title="You can change some of the data on this page."><img src="img/quest.png" height="10" width="8"></a><?php endif; ?></h5></td>
            </tr>
        </table>
        <div class="form-group" style="width: 70%; margin: auto; padding-top: 25px;">
            <p class="text-center" style="color: #dc3545;"><?php if(isset($error)){ echo $error; } ?></p>
            <form class="needs-validation" method="POST" novalidate>
                <div class="form-group">
                    <label for="surfaceArea">Surface Area :</label>
                    <input type="number" class="form-control" min="0" name="surfaceArea" id="surfaceArea" value="<?php echo $getCountryInfo->SurfaceArea; ?>" placeholder="Surface Area" >
                </div>

                <div class="form-group">
                    <label for="population">Population :</label>
                    <input type="number" class="form-control" min="0" name="population" id="population" value="<?php echo $getCountryInfo->Population; ?>" placeholder="Population" >
                </div>

                <div class="form-group">
                    <label for="lifeExpectancy">Life Expectancy :</label>
                    <input type="number" class="form-control" min="0" step="0.01" name="lifeExpectancy" id="lifeExpectancy" value="<?php echo $getCountryInfo->LifeExpectancy; ?>" placeholder="Life Expectancy" >
                </div>

                <div class="form-group">
                    <label for="gnp">GNP :</label>
                    <input type="number" class="form-control" min="0" name="gnp" id="gnp" value="<?php echo $getCountryInfo->GNP; ?>" placeholder="GNP" >
                </div>

                <div class="form-group">
                    <label for="gnpoid">GNPOld :</label>
                    <input type="number" class="form-control" min="0" step="0.01" name="gnpold" id="gnpold" value="<?php echo $getCountryInfo->GNPOld; ?>" placeholder="GNPOld" >
                </div>

                <div class="form-group">
                    <label for="text">Head Of State :</label>
                    <input type="text" class="form-control" name="headOfState" id="headOfState" value="<?php echo $getCountryInfo->HeadOfState; ?>" placeholder="Head Of State" >
                </div>
                <h4 class="text-center"><button style="margin: auto;" class="contbtn" name="validate" type="submit">Validate</button></h4>
            </form>
                <?php if(teacherLogged()): ?>
                <form class="needs-validation"  method="POST">
                    <br><br><br>
                    <div style="width: 90%; margin: auto;">
                        <p class="lead text-center" style="font-size: 17px;">If the data(s) you wish to modify is not available, please inform the administrator so that he can modify the database. </p>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="3" placeholder="Message..." required></textarea><br>
                        <h4 class="text-right"><button style="margin: auto;" class="contbtn" name="send" type="submit">Send</button></h4>
                    </div>
                </form>
                <?php endif; ?>
        </div>
    </div>
</main>
/* test */
<?php require_once 'inc/footer.php'; ?>    
