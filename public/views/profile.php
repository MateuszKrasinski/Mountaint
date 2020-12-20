<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/css/friends.css">
    <link rel="stylesheet" href="/public/css/add_trip.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b6de4b91fe.js" crossorigin="anonymous"></script>
    <title>New Trip</title>
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
                <a href="#" class="button">Settings</a>
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
                    <?php print($user->getName()) ;
                    print("  ".$user->getSurname()) ?>
                    <input class="title" name="title" type="text" placeholder="mountain#1">
                    <input onkeypress="newPoint(event)" class="point-input" name="point"
                           type="text" placeholder="mountain#2">
                </div>

                <div class="file-upload">
                    <input type="file" name="file" onchange="onFileSelected(event)" class="custom-file-input human"/>
                </div>
            </div>

            <textarea name="description" placeholder="description"></textarea>



            <button type="submit">set</button>
        </form>


    </main>
</div>


</div>

</body>
<script src="/public/js/main.js"></script>
</html>