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

    <div class="register-container">
        <form class="login" action="newUser" method="POST">
            <div class="messages">
                <?php
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name="email" type="text" placeholder="email@email.com">
            <input name="password" type="password" placeholder="password">
            <input name="confirmedPassword" type="password" placeholder="confirm password">
            <input name="name" type="text" placeholder="name">
            <input name="surname" type="text" placeholder="surname">
            <input name="phone" type="text" placeholder="phone">
            <button type="submit">REGISTER</button>
        </form>
    </div>
</body>
</html>