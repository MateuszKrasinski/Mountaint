<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/css/friends.css">
    <link rel="stylesheet" href="/public/css/messages.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b6de4b91fe.js" crossorigin="anonymous"></script>
    <script src="/public/js/messages.js" defer></script>

    <title>Trips</title>
</head>

<body>
<div class="base-container">
    <?PHP include('public/views/nav.php') ?>
    <main>
        <header>
            <div class="search-container">
                <div class="search-bar">
                    <input type="text" placeholder="search friend" name="name">
                </div>
            </div>

        </header>
        <div class="searched-friends">
            <?php foreach ($users as $user): ?>
                <div class="user-container">
                    <a href="chat?profile=<?php echo $user->getId(); ?>"><img
                                src="/public/img/<?= $user->getPhoto(); ?>"></a></div>
            <?php endforeach ?>
        </div>
        <?php foreach ($users as $user): ?>
            <div class="message">
                <div class="photo-container">
                    <div class="photo"><a href="chat?profile=<?php echo $user->getId(); ?>"><img
                                    src="/public/img/<?= $user->getPhoto(); ?>"></a></div>
                </div>
                <div class="message-container">
                    <div class="user"><?= $user->getName() . " " . $user->getSurname(); ?></div>
                    <div class="message-text"><?php foreach ($lastMessages as $msg) {
                            if (($msg->getTo() == $_SESSION['idUser'] && $msg->getFrom() == $user->getId()))
                                echo("You: " . $msg->getContent());
                            elseif ($msg->getFrom() == $_SESSION['idUser'] && $msg->getTo() == $user->getId())
                                echo($user->getName() . ": " . $msg->getContent());
                        } ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </main>
</div>


</div>

</body>

</html>