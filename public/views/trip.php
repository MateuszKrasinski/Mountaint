
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
    <script  type="text/javascript"  src="/public/js/statistics.js" defer></script>
    <script  type="text/javascript"  src="/public/js/projects.js" defer></script>
    <script  type="text/javascript"  src="/public/js/joinTrip.js" defer></script>

    <title>Friends</title>
</head>
<body>
<div class="base-container">
    <?PHP include('public/views/nav.php') ?>
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
        <select name="filter" class="filter" >
            <option value="myTrips">My Trips</option>
            <option value="joinedTrips">Joined Trips</option>
            <option value="otherTrips">Other Trips</option>
            <option value="allTrips">All Trips</option>
        </select>
        <section class="projects">
            <?php foreach ($trips as $trip): ?>
            <div class="project p1" id="<?= $trip->getId() ?>">
                <div class="project-image">
                    <a href="tripProfile?profile=<?php echo $trip->getId(); ?>">
                        <img src="public/img/uploads/<?= $trip->getImage()?>">
                    </a>
                </div>
                <div class="project-info">
                    <h2><?= $trip->getTitle() ?></h2>
                    <div class="date-container">
                        <div class="date">
                            <?= $trip->getDateStart() ?>

                        </div>
                        <div class="date">
                            <?= count($trip->getParticipant())?>
                        </div>
                    </div>
                    <p><?= $trip->getDescription() ?></p>
                    <div class="social-section">
                        <i class="fas fa-heart <?php  if(in_array($_SESSION['idUser'],$trip->getLikes())){echo("highlight"); } ?>" ><?= count($trip->getLikes()) ?></i>
                        <i class="fas fa-minus-square <?php  if(in_array($_SESSION['idUser'],$trip->getDisLikes())){echo("highlight"); } ?>"><?= count($trip->getDislikes())?></i>
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
                <a  href="tripProfile?profile=<?php echo $trip->getId(); ?>">
                    <img src="">
                </a>
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