<div class="twoByTwoContainer">
    <div class="widget2">
        <h2>New Task</h2>
        <form action="/task/addTask" method="POST" class="layout3">
            <div class="iconInputContainer">
                <i class="circle" style="border-color: <?= $_SESSION['currentCategory']->color?>; box-shadow:0 0 10px <?= $_SESSION['currentCategory']->color?>"></i>
                <input type="text" placeholder="Task Description" name="description" required>
            </div>

            <input type="date" name="date" required>
            <input type="submit" value="Create">
        </form>
    </div>
    <div class="taskScrollWidget">
        <h2><?= $_SESSION['currentCategory']->name ?></h2>
        <div class="taskScroller">
            <?php
            if (isset($_SESSION['taskOfCurrentCategory'])) {
                ?>
                <?php
                foreach ($_SESSION['taskOfCurrentCategory'] as $task) {
                    ?>
                    <a href="/task/complete?id=<?= $task['id'] ?>" class="taskContainer">
                        <i class="circle" style="border-color: <?= $_SESSION['currentCategory']->color?>; box-shadow:0 0 10px <?= $_SESSION['currentCategory']->color?>"></i>
                        <h5><?= $task['description'] ?></h5>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <div class="widget2">
        <h2>Options</h2>
        <div class="layout2">
            <a href="/task/deleteTaskOfCategory" class="option"><h5>Clear Task</h5></a>
            <a href="/category/deleteCategory" class="option"><h5>Delete Current Category</h5></a>
        </div>
    </div>
    <div class="taskScrollWidget">
        <h2>Completed</h2>
        <div class="taskScroller">
            <?php
            if (isset($_SESSION['completedTaskOfCurrentCategory'])) {
                foreach ($_SESSION['completedTaskOfCurrentCategory'] as $completedTask) {
                    ?>
                    <a href="/task/deleteTaskByID?id=<?= $completedTask['id'] ?>"
                       class="taskContainer">
                        <i class="circle" style="border-color: <?= $_SESSION['currentCategory']->color?>; box-shadow:0 0 10px <?= $_SESSION['currentCategory']->color?>"></i>
                        <h5><?= $completedTask['description'] ?></h5>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>