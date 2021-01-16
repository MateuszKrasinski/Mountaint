<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/css/friends.css">
    <link rel="stylesheet" href="/public/css/display_trip.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b6de4b91fe.js" crossorigin="anonymous"></script>
    <title>New Trip</title>
</head>

<body onload="loadPhoto('<?= $trip->getImage(); ?>')">
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
        <form onsubmit=noReload() action="joinTrip" method="POST" ENCTYPE="multipart/form-data">
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
                    <div class="title"><?= $trip->getTitle(); ?></div>

                </div>
                <div class="file-upload">
                    <input type="file" name="file" onchange="onFileSelected(event)" class="custom-file-input"/>
                </div>
            </div>
            <div class="info-container">
                <div class="left">
                    <div class="create-trip-container">
                        <?php
                        $places = explode(",", $trip->getPlaces());
                        foreach ($places as $place):?>
                            <div class="point"><i class="fas fa-map-marker-alt"></i><?= $place ?></div>
                        <?php endforeach ?>
                    </div>
                    <textarea name="description" placeholder="description">
                <?= $trip->getDescription(); ?>
            </textarea>


                    <div class="date-container">
                        <div class="date-input-container">
                            Start:
                            <div class="date-display">
                                <i class="far fa-calendar"></i><?= $trip->getDateStart(); ?></div>
                            <div class="date-display">
                                <i class="far fa-clock"></i><?= $trip->getTimeStart(); ?></div>

                        </div>
                        <div class="date-input-container">
                            Finish:
                            <div class="date-display">
                                <i class="far fa-calendar"></i><?= $trip->getDateFinish(); ?></div>
                            <div class="date-display">
                                <i class="far fa-clock"></i><?= $trip->getTimeFinish(); ?></div>

                        </div>
                    </div>
                    <div class="btn-container">
                        <button type="submit">join</button>
                    </div>

                </div>
                <div class="right">
                    <div class="right-container">
                        Participants
                        <?php
                        foreach ($participants as $participant):?>
                            <div class="participant">
                                <a href="friendProfile?profile=<?php echo $participant->getId(); ?>">
                                    <img src="/public/img/<?= $participant->getPhoto(); ?>">
                                    <?= $participant->getName() ?>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>

            </div>
        </form>


    </main>
</div>


</div>

</body>
<script src="/public/js/main.js" defer></script>
<script src="/public/js/add_trip.js" defer></script>
</html>