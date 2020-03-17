<?php
require_once "func/functions.php";

if ((adminLogged() == 1) || (teacherLogged() == 1)){
    header("Location: notFound.php");
}

if(isset($_POST["submit"])){

    $firstName = trim(htmlentities($_POST["firstName"]));
    $lastName = trim(htmlentities($_POST["lastName"]));
    $email = trim(strtolower(htmlentities($_POST["email"])));
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    if(!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password) && !empty($password2)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if(!emailExist($email)){
                if (strlen($password) > 6) {
                    if ($password == $password2) {

                        $password = hash('sha512', $_POST["password"]);

                        addUser($firstName, $lastName, $email, $password);
                        $error = "Your request will soon be processed, you will receive our decision by email.";

                    } else {
                        $error = "Your passwords must be identical !";
                    }
                } else {
                    $error = "Enter a password with more than 6 characters.";
                }
            }else {
                $error = "The email address has already been used.";
            }
        }else{
            $error = "The email address is invalid !";
        }
    }else{
        $error = "Please complete all fields.";
    }

}
?>
<?php require_once 'inc/header.php'; ?>
<main role="main">
    <div class="container">
        <table align="center">
            <tr>
                <td><h4 class="text-center">Teacher's Area </h4></td>
                <td width="5"></td>
                <td><a href="" title="Teachers can update data, test/design SQL queries, manage their SQL queries."><img src="img/quest.png" height="10" width="8"></a></td>
            </tr>
        </table>

        <div class="row">
            <div class="col-sm-6">
                <div class="col-sm-11">
                <br>
                <h5>Access Request</h5><p></p>
                    <p class="text-center" style="color: #dc3545;"><?php if(isset($error)){ echo $error; } ?></p>
                    <form method="POST" class="needs-validation" novalidate>
                        <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First name" value="<?php if(isset($_POST['firstName'])) { echo $firstName; } ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last name" value="<?php if(isset($_POST['lastName'])) { echo $lastName; } ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="email" class="form-control" id="email"  name="email" placeholder="Email" value="<?php if(isset($_POST['email'])) { echo $email; } ?>" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" id="password"  name="password2" placeholder="Confirm your password" required>
                    </div>

                    <h4 class="text-center"><button style="margin: auto;" class="contbtn" id="contbtn" name="submit" type="submit">Send</button></h4>
                </form>
                </div>
            </div>

            <div class="col-sm-6 "><br><br>
                <div class="col-sm-12">
                    <img src="img/secondcont.png" class="d-block w-100">
                </div>
                <br><p></p>
                <h4 class="text-center"><a class="contbtn" href="teacherLogin.php">Sign in</a></h4><br><p></p>
            </div>
        </div>
    </div>
</main>
<?php require_once 'inc/footer.php'; ?>