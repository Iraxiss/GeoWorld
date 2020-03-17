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

    }else{
        header("Location: notFound.php");
    }
?>
<?php require_once 'inc/header.php'; ?>
<?php require_once 'inc/adminHeader.php'; ?>


