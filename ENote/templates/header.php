<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/style.css" >
    <link rel="stylesheet" href="/css/sidepanel.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <script src="/js/extraStyling.js"></script>
    <title><?= $title; ?> | E-Note</title>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-md  fixed-top">
        <a class="nav mx-auto"  href="/category/showAll">E-NOTE</a>
          <?php if (!(isset($_SESSION['loggedIn']))){
          echo'<a href="/user/login" class="userBtnA"><input type="button" value="Log In" class="userBtn" ></a>';
          } else {
              ?>
              <a href="/category/showAll" id="home">HOME</a>
              <div class="dropdown">
                  <button class="dropbtn"></button>
                  <div class="dropdown-content">
                      <a href="/user/showProfile">Settings</a>
                      <a href="/user/logoutUser">Log Out</a>
                  </div>
              </div>
              <?php
              }
          ?>
      </nav>
    </header>
    <?php
    if(isset($_SESSION['warning'])){
        ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['warning'] ?>
        </div>
    <?php
        unset($_SESSION['warning']);
    }
    ?>
