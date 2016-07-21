<!DOCTYPE HTML>

<html>
    <head>
        <title>About myself</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="Load and view information about yourself and share it with friends!" />

        <link rel="stylesheet" href="/static/css/main.css" />
    </head>

    <body>
        <header>
            <h1>Tell us about yourself!</h1>
            <nav>
                <a href="/">Register</a> |
                <a href="/aboutmyself">My profile</a> |
                <a href="/login">Login</a> |
                <a href="/logout">Logout</a>
            </nav>
        </header>

        <p class="alert"><?php
            if(!empty($_SESSION['message']))
            {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            ?></p>