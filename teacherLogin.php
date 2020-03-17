<?php
require_once "func/functions.php";

if ((adminLogged() == 1) || (teacherLogged() == 1)){
    header("Location: notFound.php");
}

if(isset($_POST['submit'])){

    $email = trim(strtolower(htmlentities($_POST["email"])));
    $password = hash('sha512', $_POST["password"]);

    if(!empty($email) && !empty($password)){
        $userExist = verifUser($email, $password);
        if($userExist){
            $userIdRole = recupUserIdRole($email, $password);
            //var_dump($userIdRole);
            echo $userIdRole->id;
            if($userIdRole->role == 0){

                $_SESSION['teacher'] = $userIdRole->id;
                header("Location: index.php");
                exit;

            }elseif($userIdRole->role == 1){

                $_SESSION['admin'] = $userIdRole->id;
                header("Location: admin.php");
                exit;

            }
        }else{
            $error = "The email address or password do not correspond to any account .";
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
            <div style="margin: auto" class="col-sm-11">
                <br>
                <h5>Sign in</h5><p></p>
                <p class="text-center" style="color: #dc3545;"><?php if(isset($error)){ echo $error; } ?></p>
                <form class="needs-validation" method="POST" novalidate>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" id="email" value="<?php if(isset($_POST['email'])) { echo $email; } ?>" placeholder="Email" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    <h4 class="text-center"><button style="margin: auto;"  id="contbtn"  class="contbtn" name="submit" type="submit">Login</button></h4>
                    <p></p>
                   <!-- <p class="text-center"><a class="forgot" href="">Forgot your password ?</a></p> -->
                </form>
            </div>
        </div>

        <div class="col-sm-6 "><br><br>
            <div class="col-sm-12">
                <img src="img/secondcont.png" class="d-block w-100">
            </div>
            <br><p></p>
            <h4 class="text-center"><a class="contbtn" href="teacherRegister.php">Access Request</a></h4><br><p></p>
        </div>
    </div>
</div>
</main>
<?php require_once 'inc/footer.php'; ?>    