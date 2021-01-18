<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/css/friends.css">
    <link rel="stylesheet" href="/public/css/add_trip.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/friendProfile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b6de4b91fe.js" crossorigin="anonymous"></script>
    <title>New Trip</title>
</head>

<body onload="loadPhoto('<?=  $user->getPhoto();?>')">
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
            <form onsubmit=noReload() action="setProfile" method="POST" ENCTYPE="multipart/form-data">
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
                        <input class="mountain" name="name" type="text" placeholder="<?=  $user->getName().'  '.$user->getSurname();?>">
                        <input class="mountain" name="mountain1" type="text" placeholder="<?=  $user->getFirstMountain();?>">
                        <input onkeypress="newPoint(event)" class="mountain" name="mountain2"
                               type="text" placeholder="<?=  $user->getSecondMountain();?>">
                    </div>

                    <div class="file-upload">
                        <input type="file" name="file" onchange="onFileSelected(event)" class="custom-file-input"
                               onload="loadPhoto(<?=  $user->getPhoto();?>)"/>
                    </div>
                </div>

                <textarea class="description" name="description" placeholder="description">
                <?=  $user->getDescription();?>
            </textarea>



                <button type="submit">set</button>
            </form>


    </main>
</div>


</div>

</body>
<script src="/public/js/main.js"></script>
</html>