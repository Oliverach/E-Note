<div class="colContainer">
    <div class="widget1">
        <h2>Edit Personal Info</h2>
        <form action="/user/doUpdateUserInfo" method="POST" class="userProfileContainer">
            <div class="circle"></div>
            <div class="usernameContainer">
                <h5 class="leftPositionedText">Username:</h5>
                <h5 class="leftPositionedText"><?= $_SESSION['user']->username ?></h5>
            </div>
            <div class="iconInputContainer">
                <i class="bi bi-envelope"></i>
                <input type="email" placeholder="New E-Mail" name="email" required>
            </div>
            <div class="iconInputContainer">
                <i class="bi bi-lock"></i>
                <input type="password" placeholder="Current Password" name="password" required>
            </div>
            <input type="submit" value="Update Profile">
        </form>
    </div>
</div>