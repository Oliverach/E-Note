<div class="colContainer">
    <div class="widget1">
        <h2>Personal Info</h2>
        <div class="userProfileContainer">
            <img src="/images/profilePicture.png" class="profileIcon" alt="profileIcon">
            <div class="usernameContainer">
                <h4 class="leftPositionedText">Username:</h4>
                <h5 class="leftPositionedText"><?= htmlentities($_SESSION['user']->username) ?></h5>
            </div>
            <?php
            if (empty($_SESSION['user']->email)) {
                ?>
                <div class="usernameContainer">
                    <h4 class="leftPositionedText">E-Mail:</h4>
                    <h5 class="leftPositionedText">No E-Mail registered</h5>
                </div>
                <?php
            } else {
                ?>
                <div class="usernameContainer">
                    <h4 class="leftPositionedText">E-Mail:</h4>
                    <h5 class="leftPositionedText"><?= htmlentities($_SESSION['user']->email) ?></h5>
                </div>

                <?php
            }
            ?>
            <a href="/user/updateUserInfo" class="option"><h5>Edit Personal Info</h5></a>
            <a href="/user/changePassword" class="option"><h5>Change Password</h5></a>
        </div>
    </div>
</div>