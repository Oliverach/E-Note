<head>
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>

<div class="wrapper">
    <form action="/user/doLogin" method="POST" class="input">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>
    <a href="/user/create">
        <input type="submit" value="Register">
    </a>
</div>
</body>