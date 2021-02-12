<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/css/friends.css">
    <link rel="stylesheet" href="/public/css/messages.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b6de4b91fe.js" crossorigin="anonymous"></script>
    <script src="/public/js/chat.js" defer></script>

    <title>Trips</title>
</head>

<body>
<div class="base-container">
    <?PHP include('public/views/nav.php') ?>
    <main>

        <div class="msg-to">
            <a href="friendProfile?profile=<?= $user->getId(); ?>">
                <img id="<?= $user->getId(); ?>" src="/public/img/<?= $user->getPhoto(); ?>">
            </a>
            <?= $user->getName()."  ". $user->getSurname(); ?>
        </div>
        <div class="chat">
            <?php foreach ($messages as $msg): ?>
            <div class="msg <?php if ($msg->getFrom() != $_SESSION['idUser'])echo (' msg-right') ?>">
                <div class="right left">
                    <?= $msg->getContent() ?>
                </div>
            </div>
            <?php endforeach ?>
        </div>
        <div class="message-input-container">
            <input class="message-input" type="text" placeholder="type text...">
        </div>
    </main>
</div>


</div>

</body>

</html>
