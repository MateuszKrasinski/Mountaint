<?php
require_once __DIR__.'/../src/repository/UserRepository.php';
$repository = new UserRepository();
$users = array($repository->getUser(1),$repository->getUser(2),$repository->getUser(3));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/css/friends.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b6de4b91fe.js" crossorigin="anonymous"></script>
    <title>Trips</title>
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
                <a href="#" class="button">Settings</a>
            </li>
        </ul>
    </nav>
    <main>
        <header>
            <div class="search-bar">
                <form>
                    <input placeholder="search friend">
                </form>
            </div>

        </header>
        <section class="projects">
            <div class="project p1">
                <div class="project-image">
                    <img src="/public/img/person.svg">
                </div>
                <div class="project-info">
                    <h2><?=  $users[0]->getName(). " " . $users[0]->getSurname(); ?></h2>
                    <div class="want-to-go-container">
                        <div class="want-to-go">Mountain</div>
                        <div class="want-to-go">Mountain</div>
                    </div>
                    <p><?= $users[0]->getDescription(); ?></p>
                    <div class="social-section">
                        <i class="fas fa-heart"><?= $users[0]->getNumberOfHearts(); ?></i>
                        <i class="fas fa-minus-square"><?= $users[0]->getNumberOfMinuses(); ?></i>
                    </div>
                    <div class="button-container">
                        <button class="join-btn">invite</button>
                    </div>
                </div>
            </div>
            <div class="project p2">
                <div class="project-image">
                    <img src="/public/img/person.svg">
                </div>
                <div class="project-info">
                    <h2><?=  $users[2]->getName(). " " . $users[2]->getSurname(); ?></h2>
                    <div class="want-to-go-container">
                        <div class="want-to-go">Mountain</div>
                        <div class="want-to-go">Mountain</div>
                    </div>
                    <p><?= $users[2]->getDescription(); ?></p>
                    <div class="social-section">
                        <i class="fas fa-heart"><?= $users[2]->getNumberOfHearts(); ?></i>
                        <i class="fas fa-minus-square"><?= $users[2]->getNumberOfMinuses(); ?></i>
                    </div>
                    <div class="button-container">
                        <button class="join-btn">invite</button>
                    </div>
                </div>
            </div>
            <div class="project p3">
                <div class="project-image">
                    <img src="/public/img/person.svg">
                </div>
                <div class="project-info">
                    <h2><?=  $users[1]->getName(). " " . $users[1]->getSurname(); ?></h2>
                    <div class="want-to-go-container">
                        <div class="want-to-go">Mountain</div>
                        <div class="want-to-go">Mountain</div>
                    </div>
                    <p><?= $users[1]->getDescription(); ?></p>
                    <div class="social-section">
                        <i class="fas fa-heart"><?= $users[1]->getNumberOfHearts(); ?></i>
                        <i class="fas fa-minus-square"><?= $users[1]->getNumberOfMinuses(); ?></i>
                    </div>
                    <div class="button-container">
                        <button class="join-btn">invite</button>
                    </div>
                </div>
            </div>

        </section>
    </main>
</div>


</div>

</body>

</html>