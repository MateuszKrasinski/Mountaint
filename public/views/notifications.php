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

        <?php
        foreach ($notifications as $notification): ?>
            <div class="message">
                <div class="photo-container">
                    <div class="photo"><a href="friendProfile?profile=<?php echo $notification->getFrom()->getId(); ?>"><img
                                    src="/public/img/<?= $notification->getFrom()->getPhoto(); ?>"></a></div>
                </div>
                <div class="message-container">
                    <div class="user"><?= $notification->getFrom()->getName() . " " . $notification->getFrom()->getSurname(); ?></div>
                    <div class="message-text"><?= $notification->getType() ?>
                        <?php if($notification->getTrip()!=null):?>
                            <div class="photo-container">
                                <div class="trip-photo"><a href="tripProfile?profile=<?php echo $notification->getTrip()->getId(); ?>"><img
                                                src="/public/img/<?= $notification->getTrip()->getImage(); ?>"></a></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </main>
</div>


</body>

</html>