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

    // Delete message
    if(isset($_GET['delete'])){
        $msgid = $_GET['delete'];

        deletemsg($msgid);
        header("Location: messagesRead.php");
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
        <h6>Messages read</h6>
        <thead class="geonav">
        <tr>
            <th>Message</th>
            <th>date</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tr>
            <?php foreach($getreadMessages as $indice => $user): ?>
        <tr>
            <td><?php echo $user->message; ?></td>
            <td><?php echo $user->date; ?></td>
            <td><a href="messagesRead.php?delete=<?php echo $user->id; ?>" onClick="return confirm('Are you sure you want to delete this message?')" title="Delete"><img src="img/notvalid.png" width="18"></a></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
</main>
<br><p></p>
<?php require_once 'inc/footer.php'; ?>
