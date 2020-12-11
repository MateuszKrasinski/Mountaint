<?php
require_once __DIR__.'/../src/repository/TripRepository.php';
$repository = new TripRepository();
$trips = array($repository->getTrip(13), $repository->getTrip(13), $repository->getTrip(13));
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="/public/css/friends.css">
    <link rel="stylesheet" href="/public/css/style.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b6de4b91fe.js" crossorigin="anonymous"></script>
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
                <a href="profile" class="button">Settings</a>
            </li>
        </ul>
    </nav>
    <main>
        <header>
            <div class="search-bar">
                <form>
                    <input placeholder="search project">
                </form>
            </div>
            <div class="add-project">
                <a href="addTrip"><i class="fas fa-plus"> </i></a>
                <a href="addTrip"><span>add project</span></a>
            </div>
        </header>
        <section class="projects">
            <div class="project p1">
                <div class="project-image">
                    <img src="<?= $trips[0]->getImage()?>">
                </div>
                <div class="project-info">
                    <h2><?= $trips[0]->getTitle() ?></h2>
                    <div class="date-container">
                        <div class="date">
                            <?= $trips[0]->getDateStart() ?>
                        </div>
                        <div class="date">
                            <?= $trips[0]->getDateFinish() ?>
                        </div>
                    </div>
                    <p><?= $trips[0]->getDescription() ?></p>
                    <div class="social-section">
                        <i class="fas fa-heart"><?= $trips[0]->getNumberOfLikes() ?></i>
                        <i class="fas fa-minus-square"><?= $trips[0]->getNumberOfMinuses() ?></i>
                    </div>
                    <div class="button-container">
                        <button class="join-btn">join</button>
                    </div>
                </div>
            </div>
            <div class="project p2">
                <div class="project-image">
                    <img src="<?= $trips[1]->getImage()?>">
                </div>
                <div class="project-info">
                    <h2><?= $trips[1]->getTitle() ?></h2>
                    <div class="date-container">
                        <div class="date">
                            <?= $trips[1]->getDateStart() ?>
                        </div>
                        <div class="date">
                            <?= $trips[1]->getDateFinish() ?>
                        </div>
                    </div>
                    <p><?= $trips[1]->getDescription() ?></p>
                    <div class="social-section">
                        <i class="fas fa-heart"><?= $trips[1]->getNumberOfLikes() ?></i>
                        <i class="fas fa-minus-square"><?= $trips[1]->getNumberOfMinuses() ?></i>
                    </div>
                    <div class="button-container">
                        <button class="join-btn">join</button>
                    </div>
                </div>
            </div>
            <div class="project p3">
                <div class="project-image">
                    <img src="<?= $trips[2]->getImage()?>">
                </div>
                <div class="project-info">
                    <h2><?= $trips[2]->getTitle() ?></h2>
                    <div class="date-container">
                        <div class="date">
                            <?= $trips[2]->getDateStart() ?>
                        </div>
                        <div class="date">
                            <?= $trips[2]->getDateFinish() ?>
                        </div>
                    </div>
                    <p><?= $trips[2]->getDescription() ?></p>
                    <div class="social-section">
                        <i class="fas fa-heart"><?= $trips[2]->getNumberOfLikes() ?></i>
                        <i class="fas fa-minus-square"><?= $trips[2]->getNumberOfMinuses() ?></i>
                    </div>
                    <div class="button-container">
                        <button class="join-btn">join</button>
                    </div>
                </div>
            </div>

        </section>
    </main>
</div>


</div>

</body>
</html>