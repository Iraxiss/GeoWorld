<?php
    require_once "func/functions.php";

if(isset($_SESSION['admin'])){
    $getUnConfirmedUsers = getUnConfirmedUsers();
    // var_dump($getUnConfirmedUsers);

    $getConfirmedUsers = getConfirmedUsers();
    // var_dump($getConfirmedUsers);

    $nbUnconfirmedAccount = nbUnconfirmedAccount();
    // var_dump($nbUnconfirmedAccount);

    $nbconfirmAccount = nbconfirmAccount();
    // var_dump($nbconfirmAccount);

    $getUnreadMessages = getUnreadMessages();
    // var_dump($getUnreadMessages);

    $nbUnreadMessages = nbUnreadMessages();
    // var_dump($nbUnreadMessages);

    $getreadMessages = getreadMessages();
    // var_dump($getreadMessages);

    $nbreadMessages = nbreadMessages();
    // var_dump($nbreadMessages);

        // Add account
        if(isset($_GET['add'])){
            $userid = $_GET['add'];

            addusr($userid);

            header("Location: notConfirm.php");
            exit;
        }

        // Delete account
        if(isset($_GET['delete'])){
            $userid = $_GET['delete'];

            deleteusr($userid);
            header("Location: notConfirm.php");
            exit;
        }

}else{
    header("Location: notFound.php");
}

?>
<?php require_once "inc/header.php"; ?>
<?php require_once "inc/adminHeader.php"; ?>
<div class="table-responsive" style="width: 85%; margin: auto;"><p></p>
    <table class="table text-center table-bordered table-sm">
        <h6>Unconfirmed accounts</h6>
        <thead class="geonav">
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Confirm</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tr>
            <?php foreach($getUnConfirmedUsers as $indice => $user): ?>
        <tr>
            <td><?php echo $user->firstname; ?></td>
            <td><?php echo $user->lastname; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><a href="notConfirm.php?add=<?php echo $user->id; ?>" onClick="return confirm('Are you sure you want to add this account?')" title="Add"><img src="img/valid.png" width="18" title="Confirm"></a></td>
            <td><a href="notConfirm.php?delete=<?php echo $user->id; ?>" onClick="return confirm('Are you sure you want to delete this account?')" title="Delete"><img src="img/notvalid.png" width="18"></a></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
</main>
<br><p></p>
<?php require_once 'inc/footer.php'; ?>
