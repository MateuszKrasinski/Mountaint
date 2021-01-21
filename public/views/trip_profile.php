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
    <?PHP include('public/views/nav.php') ?>
    <main>
        <form onsubmit=noReload() action="joinTripFromProfile" method="POST" ENCTYPE="multipart/form-data">
            <input type="hidden" name="id" value="<?= $trip->getId(); ?>">
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
                <div class="display-image">
                    <img class="display-image" src="public/img/uploads/<?= $trip->getImage()?>">
                </div>
            </div>
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



        </form>
        <div class="right">
            <div class="right-container">
                <i class="fas fa-users"></i>
                <?php
                foreach ($participants as $participant):?>
                    <div class="participant">
                        <a href="friendProfile?profile=<?php echo $participant->getId(); ?>">
                            <img src="/public/img/<?= $participant->getPhoto(); ?>">
                            <?= $participant->getName()."  ";
                                if ($participant == $participants[0])
                                echo ('<i class="fas fa-pen"></i>');
                            ?>

                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

    </main>
</div>


</div>

</body>
<script src="/public/js/fileSelect.js" defer></script>
<script src="/public/js/addTrip.js" defer></script>
</html>