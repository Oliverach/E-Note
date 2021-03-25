<div class="twoByTwoContainer">
    <div class="widget2">
        <h2>New Task</h2>
        <form action="/task/addTask" method="POST" class="layout3">
            <div class="iconInputContainer">
                <i class="circle"
                   style="border-color: <?= $_SESSION['currentCategory']->color ?>; box-shadow:0 0 10px <?= $_SESSION['currentCategory']->color ?>"></i>
                <input type="text" placeholder="Task Description" name="description" required>
            </div>

            <input type="date" name="date" required>
            <input type="submit" value="Create">
        </form>
    </div>
    <div class="taskScrollWidget">
        <h2 title="<?= $_SESSION['currentCategory']->name ?>"><?= strlen($_SESSION['currentCategory']->name) <= 20 ? $_SESSION['currentCategory']->name : substr($_SESSION['currentCategory']->name, 0, 20)."..." ?></h2>
        <div class="taskScroller">
            <?php
            if (isset($_SESSION['taskOfCurrentCategory'])) {
                ?>
                <?php
                foreach ($_SESSION['taskOfCurrentCategory'] as $task) {
                    ?>
                    <div class="taskContainer" onclick="confirmCompleteTask('/task/complete?id=<?= $task['id'] ?>')">
                        <i class="circle" style="border-color: <?= $_SESSION['currentCategory']->color ?>; box-shadow:0 0 10px <?= $_SESSION['currentCategory']->color ?>"></i>
                        <h5 title="<?= $task['description'] ?>"><?= strlen($task['description']) <= 30 ? $task['description'] : substr($task['description'], 0, 30)."..." ?></h5>
                        <h5><?= $task['dueDate'] ?></h5>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <div class="widget2">
        <h2>Options</h2>
        <div class="layout2">
            <div class="option3" onclick="confirmClearTask('/task/deleteTaskOfCategory')"><h5>Clear Task</h5></div>
            <div class="option3" onclick="confirmDeleteCategory('/category/deleteCategory')"><h5>Delete Current
                    Category</h5></div>
        </div>
    </div>
    <div class="taskScrollWidget">
        <h2>Completed</h2>
        <div class="taskScroller">
            <?php
            if (isset($_SESSION['completedTaskOfCurrentCategory'])) {
                foreach ($_SESSION['completedTaskOfCurrentCategory'] as $completedTask) {
                    ?>
                    <div class="taskContainer" onclick="confirmDeleteTask('/task/deleteTaskByID?id=<?= $completedTask['id'] ?>')">
                        <i class="circle" style="border-color: <?= $_SESSION['currentCategory']->color ?>; box-shadow:0 0 10px <?= $_SESSION['currentCategory']->color ?>"></i>
                        <h5 title="<?= $completedTask['description'] ?>"><?= strlen($completedTask['description']) <= 30 ? $completedTask['description'] : substr($completedTask['description'], 0, 30)."..." ?></h5>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>