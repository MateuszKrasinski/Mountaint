<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/css/friends.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b6de4b91fe.js" crossorigin="anonymous"></script>
    <script src="/public/js/main.js" defer></script>
    <script src="/public/js/projects.js" defer></script>
    <script src="/public/js/searchFriend.js" defer></script>
    <script src="/public/js/statisticsFriend.js" defer></script>

    <title>Friends</title>
</head>

<body>
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
                    <i class="fas fa-user-friends highlight"></i></a>
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
        <header>
            <div class="search-bar">
                    <button class="my">my</button>
                    <input type="text" placeholder="search friend" name ="name">
            </div>

        </header>
        <section class="projects">
            <?php foreach ($users as $user): ?>
                <div class="project p1"  id="<?= $user->getId()?>">
                    <div class="project-image">
                        <a  href="friendProfile?profile=<?php echo $user->getId(); ?>">
                            <img src="/public/img/<?= $user->getPhoto(); ?>">
                        </a>
                    </div>
                    <div class="project-info">
                        <h2><?= $user->getName() . " " . $user->getSurname(); ?></h2>
                        <div class="want-to-go-container">
                            <div class="want-to-go"><?= $user->getFirstMountain(); ?></div>
                            <div class="want-to-go"><?= $user->getSecondMountain(); ?></div>
                        </div>
                        <p>
                            <?= $user->getDescription(); ?></p>
                        <div class="social-section">
                            <i class="fas fa-heart"><?= count($user->getLikes()) ?></i>
                            <i class="fas fa-minus-square"><?= count($user->getDislikes()); ?></i>
                        </div>
                        <div class="button-container">
                            <button class="join-btn">follow</button>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </section>
    </main>
</div>


</div>

</body>

</html>
<template id="friend-template">
    <div class="project p1">
        <div class="project-image">
            <a  href="">
                <img src="">
            </a>
        </div>
        <div class="project-info">
            <h2></h2>
            <div class="want-to-go-container">
                <div class="want-to-go"></div>
                <div class="want-to-go"></div>
            </div>
            <p>
            </p>
            <div class="social-section">
                <i class="fas fa-heart"></i>
                <i class="fas fa-minus-square"></i>
            </div>
            <div class="button-container">
                <button class="join-btn">invite</button>
            </div>
        </div>
    </div>
</template>