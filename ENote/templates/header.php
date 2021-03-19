<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css" >
    <link rel="stylesheet" href="/css/sidepanel.css">
    <link rel="stylesheet" href="/css/layout.css">
    <title><?= $title; ?> | Bbc MVC</title>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-md  fixed-top">
        <a class="nav mx-auto"  href="/category/showAll">E-NOTE</a>
          <?php if (!(isset($_SESSION['loggedIn']))){
          echo'<a href="/user/login" class="userBtnA"><input type="button" value="Log In" class="userBtn" ></a>';
          } else {
              echo '<a href="/user/logoutUser" class="userBtnA"><input type="button" value="Log out" class="userBtn" ></a>';
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
