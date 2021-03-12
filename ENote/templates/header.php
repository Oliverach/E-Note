<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css" >
    <title><?= $title; ?> | Bbc MVC</title>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-md  fixed-top">
        <a class="nav mx-auto navbar-brand" href="/">E-NOTE</a>
          <?php if (!(isset($_SESSION['loggedIn']))){
          echo'<a href="/user/login"><input type="button" value="Log In" class="btn btn-primary" ></a>';
          } else {
              echo '<a href="/user/logoutUser"><input type="button" value="Log out" class="btn btn-primary" ></a>';
              }
          ?>
      </nav>
    </header>

