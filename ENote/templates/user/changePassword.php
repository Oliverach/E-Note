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
            <input type="submit" value="Change Password" class="defaultBtn">
        </form>
    </div>
</div>