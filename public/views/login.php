<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/starter.css">
    <link rel="stylesheet" href="/public/css/login.css">

    <title>Login page</title>
</head>
<body>
<div class="container">
    <div class="logo-container">
        <a href="starter"><img src="/public/img/logo2.png"></a>
    </div>

    <div class="login-container">
        <form class="login" action="login" method="POST" autocomplete="off">
            <div class="messages">
                <?php
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <input type="text" name="email" placeholder="login" autocomplete="off">
            <input type="password" name="password" placeholder="password" autocomplete="off">
            <button TYPE="submit">LOGIN</button>
        </form>
    </div>
</body>
</html>