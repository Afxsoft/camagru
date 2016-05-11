<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Camagru</title>

    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="main">
    <header>
        <div class="center">
            <div class="top_header">
                <div class="logo">
                    <a href="index.php" title="home" alt="home">Camagru</a>
                </div>
                <div class="right_header">
                    <div class="login">
                    </div>
                    <div class="connect">
                        <?php if(empty($_SESSION['loggued_on_user'])) {?>
                            <a href="index.php?page=login">Se connecter</a>
                        <?php } else {?>
                            <a href="index.php?page=login&action=logout">Se deconnecter</a>
                        <?php }?>
                    </div>

                    <?php if(empty($_SESSION['loggued_on_user'])) {?>
                        <div class="connect">
                            <a href="index.php?page=user_create">  S'inscrire</a>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </header>
    <div class="fapfap">
        <div id='cssmenu' class="center">
            <ul>
                <li><a href='index.php'><span>Home</span></a></li>
                <li class='active has-sub'><a href='index.php?page=galery'><span>Galery</span></a>
                </li>
                <li><a href='#'><span>About</span></a></li>
                <li class='last'><a href='#'><span>Contact</span></a></li>
            </ul>
        </div>
    </div>
    <div class="container">
<?php
    if (!empty($_SESSION['MAIN_MESSAGE'])){
        echo $_SESSION['MAIN_MESSAGE'];
        unset($_SESSION['MAIN_MESSAGE']);
    }
?>