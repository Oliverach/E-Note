<div class="unloggedContainer">
    <div class="widget1">
        <h2>Login</h2>
        <form action="/user/doLogin" method="POST" class="layout4">
            <div class="iconInputContainer">
                <i class="bi bi-person"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="iconInputContainer">
                <i class="bi bi-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <input type="submit" value="Login" class="defaultBtn">
            <a href="/user/create" class="button"><p>Register</p></a>
        </form>
    </div>
</div>