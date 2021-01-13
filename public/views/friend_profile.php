<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/css/friends.css">
    <link rel="stylesheet" href="/public/css/add_trip.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <script src="/public/js/goProfile.js" defer></script>
    <link rel="stylesheet" href="/public/css/friendProfile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b6de4b91fe.js" crossorigin="anonymous"></script>
    <title>New Trip</title>
</head>

<body onload="loadPhoto('<?= $user->getPhoto(); ?>')">
<div class="base-container">
    <nav>
        <a href="trip"><img src="/public/img/logo2.png"></a>
        <ul>
            <li>
                <a href="trip"><i class="fas fa-hiking"></i></a>
                <a href="trip" class="button">Trips</a>
            </li>
            <li>
                <a href="friend">
                    <i class="fas fa-user-friends"></i></a>
                <a href="friend" class="button">Friend</a>
            </li>
            <li>
                <a href="messages"><i class="fas fa-envelope-open "></i></a>
                <a href="messages" class="button">Messages</a>
            </li>
            <li>
                <a href="notifications"><i class="fas fa-bell"></i></a>
                <a href="notifications" class="button">Notifications</a>
            </li>
            <li>
                <i class="fas fa-cog"></i>
                <a href="profile" class="button">Profile</a>
            </li>
        </ul>
    </nav>
    <main>
        <div class="messages">
            <?php
            if (isset($messages)) {
                foreach ($messages as $message) {
                    echo $message;
                }
            }
            ?>
        </div>
        <div class="first-line-container">
            <div class="first-line-left-container">
                <div class="mountain"><?= $user->getName(); ?>      <?= $user->getSurname(); ?></div>
                <div class="mountain"><?= $user->getSecondMountain(); ?></div>
                <div class="mountain"><?= $user->getFirstMountain(); ?></div>

            </div>

            <div class="photo">
                <img src="/public/img/uploads/<?= $user->getPhoto(); ?>" alt="profile photo" width="30px">
                <div class="social-section">
                    <i class="fas fa-heart"><?= $user->getLikes() ?></i>
                    <i class="fas fa-minus-square"><?= $user->getDislikes() ?></i>
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>
        </div>

        <div class="description">
            <?= $user->getDescription(); ?>
        </div>



    </main>
</div>


</div>

</body>
<script src="/public/js/main.js" defer></script>
<script src="/public/js/profileFriend.js" defer></script>
</html>