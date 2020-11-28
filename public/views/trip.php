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
                <a href="#" class="button">Settings</a>
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
            <div class="project 1">
                <div class="project-image">
                    <img src="/public/img/background.png">
                </div>
                <div class="project-info">
                    <h2>Giewont</h2>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus, repellendus totam ab soluta
                        sunt architecto eos distinctio vitae. Ab eius maxime harum quis quia alias reprehenderit
                        perferendis totam eaque provident? </p>
                    <div class="social-section">
                        <i class="fas fa-heart">600</i>
                        <i class="fas fa-minus-square">600</i>
                    </div>
                    <div class="button-container">
                        <button class="join-btn">join</button>
                    </div>
                </div>
            </div>
            <div class="project p2">
                <div class="project-image">
                    <img src="/public/img/background.png">
                </div>
                <div class="project-info">
                    <h2>Giewont</h2>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Animi cupiditate nisi fuga iure porro
                        odio unde beatae sit aspernatur quidem. Beatae consectetur, necessitatibus voluptatum labore aut
                        tempora sapiente sunt quasi.</p>
                    <div class="social-section">
                        <i class="fas fa-heart">600</i>
                        <i class="fas fa-minus-square">600</i>
                    </div>
                    <div class="button-container">
                        <button class="join-btn">join</button>
                    </div>
                </div>
            </div>
            <div class="project p3">
                <div class="project-image">
                    <img src="/public/img/uploads/<?= $project->getImage() ?>">
                </div>
                <div class="project-info">
                    <h2><?= $project->getTitle() ?></h2>
                    <div class="date-container">
                        <div class="date">
                            <?= $project->getDateStart() ?>
                        </div>
                        <div class="date">
                            <?= $project->getDateFinish() ?>
                        </div>
                    </div>
                    <p>
                        <?= $project->getDescription() ?>
                    </p>
                    <div class="social-section">
                        <i class="fas fa-heart">600</i>
                        <i class="fas fa-minus-square">600</i>
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