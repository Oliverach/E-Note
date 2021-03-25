<div class="unloggedContainer">
    <div class="widget1">
        <h2>Sign In</h2>
        <form action="/user/doCreate" method="post" class="layout4">

            <div class="iconInputContainer">
                <i class="bi bi-person"></i>
                <input id="username" name="username" type="text"  placeholder="Username" required>
            </div>
            <div class="iconInputContainer">
                <i class="bi bi-lock"></i>
                <input id="password" name="password" type="password"  placeholder="Password" required>
            </div>
            <div class="iconInputContainer">
                <i class="bi bi-shield-lock"></i>
                <input id="confirm_password" name="confirm_password" type="password"  placeholder="Confirm Password" required>
            </div>

            <div class="row">
                <div class="col">
                    <a href="/user/login" class="SignInButtons button"><p>Log In</p></a>
                </div>
                <div class="col">
                    <input class="SignInButtons button" type="submit" value="Sign In">
                </div>
            </div>

        </form>
    </div>
</div>