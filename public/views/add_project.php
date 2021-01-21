<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/css/friends.css">
    <link rel="stylesheet" href="/public/css/add_trip.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b6de4b91fe.js" crossorigin="anonymous"></script>
    <script src="/public/js/fileSelect.js" defer></script>
    <script src="/public/js/addTrip.js" defer></script>
    <title>New Trip</title>
</head>

<body>
<div class="base-container">
    <?PHP include('public/views/nav.php') ?>
    <main>
        <form onsubmit=noReload() action="addTrip" method="POST" ENCTYPE="multipart/form-data">
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
                    <input class="title" name="title" type="text" placeholder="title">
                    <input onkeypress="newPoint(event)" class="point-input" name="point"
                           type="text" placeholder="next point">
                </div>

                <div class="file-upload">
                    <input type="file" name="file" onchange="onFileSelected(event)" class="custom-file-input"/>
                </div>
            </div>
            <div class="create-trip-container">
                <input type="hidden"  class="places" name="places" value="whatever" />
            </div>
            <textarea name="description" placeholder="description"></textarea>


            <div class="date-container">
                <div class="date-input-container">
                    Start:
                    <input type="date" class="date-input" name="date_start"  placeholder="start">
                    <input type="time" class="date-input" name="time_start" >
                </div>
                <div class="date-input-container">
                    Finish:
                    <input type="date" class="date-input" name="date_finish"  placeholder="finish">
                    <input type="time" class="date-input" name="time_finish" ">

                </div>
            </div>
            <button type="submit">new trip</button>
        </form>


    </main>
</div>


</div>

</body>

</html>