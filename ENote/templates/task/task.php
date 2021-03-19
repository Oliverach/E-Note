<div class="doubleColContainer">
    <div class="wrapper2">
        <form action="/task/addTask" method="POST" class="wrapper3">
            <input type="text" placeholder="Task Description" name="description" required>
            <input type="date" name="date" required>
            <input type="submit" value="Create">
        </form>
        <div class="scrollWrapper">
            <h2>Completed</h2>
            <div class="scroller">
                <?php
                if (isset($_SESSION['completedTaskOfCurrentCategory'])) {
                    foreach ($_SESSION['completedTaskOfCurrentCategory'] as $completedTask) {
                        ?>
                        <a href="/task/complete?id=<?= $completedTask['id'] ?>" class="task"><?= $completedTask['description'] ?></a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="scrollWrapper">
        <h2><?= $_SESSION['currentCategoryName'] ?></h2>
        <div class="scroller">
            <?php
            if (isset($_SESSION['taskOfCurrentCategory'])) {
                ?>
                <?php
                foreach ($_SESSION['taskOfCurrentCategory'] as $task) {
                    ?>
                    <a href="/task/complete?id=<?= $task['id'] ?>" class="task"><?= $task['description'] ?></a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>