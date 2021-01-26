<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/css/friends.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b6de4b91fe.js" crossorigin="anonymous"></script>
    <script src="/public/js/fileSelect.js" defer></script>
    <script src="/public/js/friends.js" defer></script>

    <title>Friends</title>
</head>

<body>
<div class="base-container">
    <?PHP include('public/views/nav.php') ?>
    <main>
        <header>
            <div class="search-bar">
                    <input type="text" placeholder="search friend" name ="name">
            </div>

        </header>
        <select name="filter" class="filter" >
            <option value="allFriends">All</option>
            <option value="followed">Followed</option>
            <option value="notFollowed">Others</option>
        </select>
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
                            <?= $user->getDescription()?></p>
                        <div class="social-section">
                            <i class="fas fa-heart <?php  if(in_array($_SESSION['idUser'],$user->getLikes())){echo("highlight"); } ?>" ><?= count($user->getLikes()) ?></i>
                            <i class="fas fa-minus-square <?php  if(in_array($_SESSION['idUser'],$user->getDisLikes())){echo("highlight"); } ?>"><?= count($user->getDislikes())?></i>

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
            <a  href="friendProfile?profile=<?php echo $user->getId(); ?>">
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
                <i class="fas fa-heart <?php  if(in_array($_SESSION['idUser'],$user->getLikes())){echo("highlight"); } ?>" ><?= count($user->getLikes()) ?></i>
                <i class="fas fa-minus-square <?php  if(in_array($_SESSION['idUser'],$user->getDisLikes())){echo("highlight"); } ?>"><?= count($user->getDislikes())?></i>
            </div>
            <div class="button-container">
                <button class="join-btn">follow</button>
            </div>
        </div>
    </div>
</template>