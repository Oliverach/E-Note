<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/sidepanel.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <script src="/js/confirmation.js"></script>
    <title><?= $title; ?> | E-Note</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md  fixed-top">
        <a class="nav mx-auto" href="/category">E-NOTE</a>
        <?php if (isset($_SESSION['loggedIn'])) { ?>
            <a href="/category" id="home">HOME</a>
            <div class="dropdown">
                <img src="/images/profilePicture.png" class="dropbtn" alt="profileIcon" width="40" height="40">
                <div class="dropdown-content">
                    <a href="/user">Settings</a>
                    <a href="/user/logoutUser">Log Out</a>
                </div>
            </div>
            <?php
        }
        ?>
    </nav>
</header>
<?php
if (isset($_SESSION['loggedIn'])) {
    $position = "55%";
} else {
    $position = "50%";
}
if (isset($_SESSION['warning'])) {

    ?>
    <div class="alert alert-danger" style="left:<?= $position ?>" role="alert">
        <?= $_SESSION['warning'] ?>
    </div>
    <?php
    unset($_SESSION['warning']);
}
?>
<?php
if (isset($_SESSION['success'])) {
    ?>
    <div class="alert alert-success" style="left:<?= $position ?>" role="alert">
        <?= $_SESSION['success'] ?>
    </div>
    <?php
    unset($_SESSION['success']);
}
?>
