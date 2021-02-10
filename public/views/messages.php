<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/css/friends.css">
    <link rel="stylesheet" href="/public/css/messages.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b6de4b91fe.js" crossorigin="anonymous"></script>
    <title>Trips</title>
</head>

<body>
<div class="base-container">
    <?PHP include('public/views/nav.php') ?>
    <main>
        <?php foreach ($users as $user): ?>
        <div class="message">
            <div class="photo-container">
                <div class="photo"><a href="chat?profile=<?php echo $user->getId(); ?>"><img src="/public/img/<?= $user->getPhoto(); ?>"></a></div>
            </div>
            <div class="message-container">
                <div class="user"><?= $user->getName() . " " . $user->getSurname(); ?></div>
                <div class="message-text">Last message!
                </div>
            </div>
        </div>
        <?php endforeach ?>

    </main>
</div>


</div>

</body>

</html>