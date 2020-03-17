<?php
    require_once "func/functions.php";

    if(isset($_SESSION['teacher'])){
        $sessionTeacher = $_SESSION['teacher'];
        $userInfo = recupUserInfo($sessionTeacher);
    }
?>
<?php require_once 'inc/header.php'; ?>
<main role="main">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <table>
                    <tr>
                        <td>
                            <a href="https://earth.google.com/web/@-34.60960027,-100.74439882,-13267.34577873a,29549777.35057354d,35y,0h,0t,0r" target="_blank">
                                <img src="img/logo.png" width="55" height="55" >
                            </a>
                        </td>
                        <td>
                            <?php if(teacherLogged()): ?>
                                <h4 class="text-center">&nbsp;&nbsp;Hi <?php echo $userInfo->firstname ?></h4>
                            <?php else: ?>
                                <h4 class="text-center">&nbsp;&nbsp;Discover The World</h4>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <?php if(teacherLogged()): ?>
                    <p></p>
                    <p class="lead">Thanks to your profile, you have the right to update the data on the page continent.
                    <br>You can also save and manage your sql queries. </p>
                    <br>
                <?php else: ?>
                    <p></p>
                    <p class="lead">Our application is intended for history and geography teachers.</p>
                    <p class="lead">It allows teachers and students alike to consult geopolitical and economic data on the
                        planet.</p><br>
                <?php endif; ?>

                <div id="carouselExampleFade" class="row carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/great.jpg" class="carimg">
                        </div>
                        <div class="carousel-item">
                            <img src="img/petra.jpg" class="carimg">
                        </div>
                        <div class="carousel-item">
                            <img src="img/christ.jpg" class="carimg">
                        </div>
                        <div class="carousel-item">
                            <img src="img/machu.jpg" class="carimg">
                        </div>
                        <div class="carousel-item">
                            <img src="img/pyramid.jpg" class="carimg">
                        </div>
                        <div class="carousel-item">
                            <img src="img/colosseum.jpg" class="carimg">
                        </div>
                        <div class="carousel-item">
                            <img src="img/tajmahal.jpg" class="carimg">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 "><br><br>
                <div class="col-sm-12">
                    <img src="img/continents.png" class="d-block w-100">
                </div>
                <br><p></p><h4 class="text-center"><a class="contbtn" href="" data-toggle="modal" data-target="#continentsModalCenter">Continents</a></h4><br><p></p>

                <div class="col-sm-13">
                    <p class="lead">The word continent comes from the Latin continere for "holding together", or
                        continens terra, the "continuous land". Literally, the term refers to a vast, continuous expanse
                        of land on the surface of the earth.</p>
                </div>
            </div>
        </div>
        <br>
        <p></p>

        <h4 class="text-center"><img src="img/seven.png" width="55" height="55"> continents</h4><br>

        <p class="lead"><strong><a class="text-success" href="countries.php?continent=Africa">Africa</a></strong> is a
            continent that covers 6% of the Earth's surface and 20% of the land surface. Its surface area is 30,415,873
            km² including islands, making it the third largest in the world if America is counted as a single continent.
        </p>
        <p class="lead"><strong><a style="color: maroon;"
                                   href="countries.php?continent=Antarctica">Antarctica</a></strong>, sometimes referred
            to as "the Southern Continent" or "the White Continent", is the southernmost continent on Earth. Located
            around the South Pole, it is surrounded by the Atlantic, Indian and Pacific Oceans and the Ross and Weddell
            Seas.</p>
        <p class="lead"><strong><a style="color: crimson;" href="countries.php?continent=Asia">Asia</a></strong> is one
            of the seven continents or part of the Eurasian or Afro-Eurasian supercontinents of the Earth. With
            43,810,582 km² of land and 4.3 billion inhabitants, Asia is the largest and most populated continent.</p>
        <p class="lead"><strong><a class="text-primary" href="countries.php?continent=Europe">Europe</a></strong> is
            considered politically as a continent or geographically as part of the supercontinents of Eurasia and
            Afro-Eurasia. It is sometimes called the "Old Continent" or "Old World", as opposed to the "New World".</p>
        <p class="lead"><strong><a class="text-body" href="countries.php?continent=North%20America">North
                    America</a></strong> is a continent in its own right or a subcontinent of America depending on the
            division adopted for the continents. It is surrounded by the Pacific Ocean to the west, the Arctic Ocean to
            the north and the Atlantic Ocean to the east.</p>
        <p class="lead"><strong><a style="color: fuchsia;" href="countries.php?continent=South%20America">South
                    America</a></strong> is a continent or subcontinent and the southern part of America. It is located
            entirely in the Western Hemisphere and mainly in the Southern Hemisphere. It is bordered to the west by the
            Pacific Ocean and to the north and east by the Atlantic Ocean.</p>
        <p class="lead"><strong><a class="text-warning" href="countries.php?continent=Oceania">Oceania</a></strong> is a
            region of the world. It is the smallest of the Earth's emerged continents. Situated in the Pacific Ocean, it
            covers an area of 8,525,989 km² and is home to more than 38 million people, spread over sixteen independent
            states and fifteen territories.</p>

        <div class="row">
            <div class="col-sm-6"><br>
                <p class="lead">A flag is a piece of cloth attached to a staff that represents the "legal person" of a
                    group or community: nation, territory, city, organization, trading company or regiment.</p>
            </div>

            <div class="col-sm-5">
                <div class="col-sm-12"><p></p>
                    <img src="img/contlast.png" class="img-fluid">
                    <br><p></p>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modals -->

    <div class="modal fade" id="changeModalCenter" tabindex="-1" role="dialog" aria-labelledby="changeModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="geonav navbar modal-header ">
                    <h5 class="modal-title" id="changeModalLongTitle">Change last name / first name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="lead text-center">Enter your password to confirm the deletion of your account.</p>
                    <form class="needs-validation" method="POST" novalidate>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First name" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name" required>
                        </div>
                        <h4 class="text-center"><button style="margin: auto;" class="contbtn" name="submit" type="submit">Validate</button></h4>
                        <p></p>
                    </form>
                </div>
                <div class="modal-footer">
                    <p> <span style="font-size: 12px;" class="text-muted">GeoWorld &copy; 2020</span> </p>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="paswdModalCenter" tabindex="-1" role="dialog" aria-labelledby="paswdModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="geonav navbar modal-header ">
                    <h5 class="modal-title" id="deleteModalLongTitle">Change my password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" method="POST" novalidate>
                        <div class="mb-3">
                            <p class="text-center" style="color: #dc3545;"><?php if(isset($error)){ echo $error; } ?></p>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required><p></p>
                            <input type="password" class="form-control" name="password" id="password" placeholder="New password" required><p></p>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Confirm password" required>
                        </div>
                        <h4 class="text-center"><button style="margin: auto;" class="contbtn" name="submit" type="submit">Validate</button></h4>
                        <p></p>
                    </form>                </div>
                <div class="modal-footer">
                    <p> <span style="font-size: 12px;" class="text-muted">GeoWorld &copy; 2020</span> </p>
                </div>
            </div>
        </div>
    </div>

</main>
<?php require_once 'inc/footer.php'; ?>
