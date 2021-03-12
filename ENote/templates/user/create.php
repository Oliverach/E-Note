<head>
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>

    <form action="/user/doCreate" method="post" class="wrapper4r">
        <input id="username" name="username" type="text" class="form-control" placeholder="Username" required>
        <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
        <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" required>
        <button type="submit" name="send" class="btn btn-primary">Register</button>
    </form>

</body>