<?php
require_once "func/functions.php";

if(isset($_SESSION['admin'])){
    $getUnConfirmedUsers = getConfirmedUsers();
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


    // Add message
    if(isset($_GET['add'])){
        $msgid = $_GET['add'];

        addmsg($msgid);

        header("Location: unreadMessages.php");
        exit;
    }

    // Delete message
    if(isset($_GET['delete'])){
        $msgid = $_GET['delete'];

        deletemsg($msgid);
        header("Location: unreadMessages.php");
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
        <h6>Unread Messages</h6>
        <thead class="geonav">
        <tr>
            <th>Message</th>
            <th>date</th>
            <th>Read</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tr>
            <?php foreach($getUnreadMessages as $indice => $user): ?>
        <tr>
            <td><?php echo $user->message; ?></td>
            <td><?php echo $user->date; ?></td>
            <td><a href="unreadMessages.php?add=<?php echo $user->id; ?>" title="Delete"><img src="img/valid.png" width="18"></a></td>
            <td><a href="unreadMessages.php?delete=<?php echo $user->id; ?>" onClick="return confirm('Are you sure you want to delete this message?')" title="Delete"><img src="img/notvalid.png" width="18"></a></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
</main>
<br><p></p>
<?php require_once 'inc/footer.php'; ?>
