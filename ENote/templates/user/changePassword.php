<div class="colContainer">
    <div class="widget1">
        <h2>Change Password</h2>
        <form action="/user/doChangePassword" method="POST" class="layout4">
            <div class="iconInputContainer">
                <i class="bi bi-lock"></i>
                <input type="password" name="newPW" placeholder="New Password" required>
            </div>
            <div class="iconInputContainer">
                <i class="bi bi-shield-lock"></i>
                <input type="password" name="confirmNewPW" placeholder="Confirm New Password" required>
            </div>
            <div class="iconInputContainer">
                <i class="bi bi-lock"></i>
                <input type="password" name="currentPW" placeholder="Current Password" required>
            </div>
            <div class="row">
                <div class="col">
                    <a href="/user" class="SignInButtons button"><p>Return</p></a>
                </div>
                <div class="col">
                    <input type="submit" class="SignInButtons button" value="Change Password">
                </div>
            </div>
        </form>
    </div>
</div>