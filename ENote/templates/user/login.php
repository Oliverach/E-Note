<head>
    <link rel="stylesheet" href="/css/layout.css">
</head>
<body>
<h1>Log In</h1>
<div class="wrapper">

    <form action="/user/doLogin" method="POST" class="input">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login" class="defaultBtn">
        <a href="/user/create" >
            <input type="button" value="Register">
        </a>
        <?php
        if ($_SESSION['LoginFailed'] == true){
            echo '<div class="alert">Login Failed</div>';
            $_SESSION['LoginFailed'] = false;
        }
        ?>
    </form>

</div>
</body>