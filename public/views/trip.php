
<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="/public/css/friends.css">
    <link rel="stylesheet" href="/public/css/style.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b6de4b91fe.js" crossorigin="anonymous"></script>
    <script src="/public/js/main.js" defer></script>
<!--    <script src="/public/js/projects.js" defer></script>-->
    <script  type="text/javascript"  src="/public/js/search.js" defer></script>

    <title>Friends</title>
</head>
<body>
<div class="base-container">
    <nav>

        <a href="trip"><img src="/public/img/logo2.png"></a>
        <ul>
            <li>
                <a href="trip"><i class="fas fa-hiking highlight"></i></a>
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
        <header>
            <div class="search-bar">
                    <input placeholder="search project">
            </div>
            <div class="add-project">
                <a href="addTrip"><i class="fas fa-plus"> </i></a>
                <a href="addTrip"><span>add project</span></a>
            </div>
        </header>
        <section class="projects">
            <?php foreach ($trips as $trip): ?>
            <div class="project p1">
                <div class="project-image">
                    <img src="public/img/uploads/<?= $trip->getImage()?>">
                </div>
                <div class="project-info">
                    <h2><?= $trip->getTitle() ?></h2>
                    <div class="date-container">
                        <div class="date">
                            <?= $trip->getDateStart() ?>
                        </div>
                        <div class="date">
                            <?= $trip->getTimeStart() ?>
                        </div>
                    </div>
                    <p><?= $trip->getDescription() ?></p>
                    <div class="social-section">
                        <i class="fas fa-heart"><?= $trip->getLikes() ?></i>
                        <i class="fas fa-minus-square"><?= $trip->getDislikes() ?></i>
                    </div>
                    <div class="button-container">
                        <button class="join-btn">join</button>
                    </div>
                </div>
            </div>
            <?php endforeach  ?>
        </section>
    </main>
</div>


</div>

</body>
</html>

<template id="project-template">
    <div class="project p1">
        <div class="project-image">
            <img src="">
        </div>
        <div class="project-info">
            <h2>info</h2>
            <div class="date-container">
                <div class="date">
                    data
                </div>
                <div class="date">
                    data
                </div>
            </div>
            <p>opis</p>
            <div class="social-section">
                <i class="fas fa-heart">0</i>
                <i class="fas fa-minus-square">0</i>
            </div>
            <div class="button-container">
                <button class="join-btn">join</button>
            </div>
        </div>
    </div>

</template>