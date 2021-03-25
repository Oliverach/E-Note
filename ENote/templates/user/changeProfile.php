<div class="colContainer">
    <div class="widget1">
        <h2>Edit Personal Info</h2>
        <form action="/user/doUpdateUserInfo" method="POST" class="userProfileContainer">
            <img src="/images/profilePicture.png" class="profileIcon" alt="profileIcon">
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
            <div class="row">
                <div class="col">
                    <a href="/user" class="SignInButtons button"><p>Return</p></a>
                </div>
                <div class="col">
                    <input type="submit" class="SignInButtons button" value="Update Profile">
                </div>
            </div>
        </form>
    </div>
</div>