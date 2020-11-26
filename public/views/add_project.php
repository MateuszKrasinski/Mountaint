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
        <header>
            <div class="search-bar">
                <form>
                    <input placeholder="type next point">
                </form>
            </div>
        </header>
        <div class="create-trip-container">
            <div class="point">place #1</div>
            <div class="point">place #1</div>
            <div class="point">place #1</div>
            <div class="point">place #1</div>
        </div>
        <div class="description-container">
            <div class="title">
                Description:
            </div>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. In excepturi voluptatum exercitationem unde sed
                voluptas fugit velit accusantium explicabo nobis praesentium labore, laboriosam quam magni inventore
                nihil incidunt aspernatur optio.
        </div>
        <div class="date-container">
            <form class="input-holder">
                <label>Start:</label>
                <input type="date" id="start" name="trip-start" value="2020-11-1">

            </form>
            <form class="input-holder">
                <label>Finish:</label>
                <input type="date" id="finish" name="trip-start" value="2020-11-1">
            </form>
        </div>
        <div class="add-trip-container">
            <button>add trip</button>
        </div>


    </main>
</div>


</div>

</body>

</html>