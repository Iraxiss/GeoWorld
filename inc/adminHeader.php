<main role="main">
    <div class="container">
        <h4>Hi boss ! &#128522;</h4>
        <div>
            <table class="table table-responsive-lg text-center">
                <tr>
                    <form method="post">
                        <td><a href="notConfirm.php" class="btn btn-light btn-sm btn-outline-secondary">Unconfirmed accounts (<?php echo $nbUnconfirmedAccount->nbUnconfirmedAccount; ?>)</a></td>
                        <td><a href="confirm.php" class="btn btn-light btn-sm btn-outline-secondary">Confirmed accounts (<?php echo $nbconfirmAccount->nbconfirmAccount; ?>)</a></td>
                        <td><a href="unreadMessages.php" class="btn btn-light btn-sm btn-outline-secondary">Unread messages (<?php echo $nbUnreadMessages->nbUnreadMessages; ?>)</a></td>
                        <td><a href="messagesRead.php" class="btn btn-light btn-sm btn-outline-secondary">Messages read (<?php echo $nbreadMessages->nbreadMessages; ?>)</a></td>
                    </form>
                </tr>
            </table>
        </div>