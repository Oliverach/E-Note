<head>
    <link rel="stylesheet" href="/css/layout.css">
</head>
<body>
<h1>Sign In</h1>
    <form action="/user/doCreate" method="post" class="wrapper4r">
        <input id="username" name="username" type="text"  placeholder="Username" required>
        <input id="password" name="password" type="password"  placeholder="Password" required>
        <input id="confirm_password" name="confirm_password" type="password"  placeholder="Confirm Password" required>
        <input type="submit" value="Sign In">
        <?php
        if (isset($_SESSION['unmatchingPW']) && $_SESSION['unmatchingPW'] == true ){
            echo '<div class="alert">Unmatching Passwords</div>';
            $_SESSION['unmatchingPW'] = false;
        }
        if (isset($_SESSION['usernameDuplicate']) && $_SESSION['usernameDuplicate'] == true ){
            echo '<div class="alert">User Already Exists</div>';
            $_SESSION['usernameDuplicate'] = false;
        }
        ?>
    </form>
</body>