<?php
if (isset($_SESSION['userCategory'])) {
    ?>
    <div class="doubleColContainer">
        <div class="doubleRowContainer">
            <div class="taskScrollWidget">
                <h2>Due Today</h2>
                <div class="taskScroller">
                    <?php
                    if (isset($_SESSION['taskOfCurrentDay'])) {
                        foreach ($_SESSION['taskOfCurrentDay'] as $task) {
                            $description = htmlentities($task['description']);
                            $dueDate = htmlentities($task['dueDate']);
                            ?>
                            <div class="taskContainer" onclick="confirmCompleteTask('/task/complete?id=<?= $task['id'] ?>')">
                                <i class="circle" style="border-color: <?= $task['color'] ?>; box-shadow:0 0 10px <?= $task['color'] ?> ;"></i>
                                <h5 title="<?= $description ?>"><?= strlen($description) <= 30 ? $description : substr($description, 0, 30)."..." ?></h5>
                                <h5><?= $dueDate ?></h5>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>
            </div>
            <div class="taskScrollWidget">
                <h2>Due Tomorrow</h2>
                <div class="taskScroller">
                    <?php
                    if (isset($_SESSION['taskOfNextDay'])) {
                        foreach ($_SESSION['taskOfNextDay'] as $task) {
                            $description = htmlentities($task['description']);
                            $dueDate = htmlentities($task['dueDate']);
                            ?>
                            <div onclick="confirmCompleteTask('/task/complete?id=<?= $task['id'] ?>')" class="taskContainer">
                                <i class="circle" style="border-color: <?= $task['color'] ?>; box-shadow:0 0 10px <?= $task['color'] ?> ;"></i>
                                <h5 title="<?= $description ?>"><?= strlen($description) <= 30 ? $description : substr($description, 0, 30)."..." ?></h5>
                                <h5><?= $dueDate ?></h5>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
        <div class="titleContainer">
            <h3 class="allCategoryTitle">All Category</h3>
            <div class="categoryScrollerWidget">
                <div class="categoryScroller">
                    <?php
                    if (isset($_SESSION['taskAmountByCategory'])) {
                        foreach ($_SESSION['taskAmountByCategory'] as $category) {
                            $name = htmlentities($category['name']);
                            $amount = htmlentities($category['amount']);
                            ?>
                            <a href="/task/?category_id=<?= $category['category_id'] ?>" class="categoryContainer">
                                <i class="circle" style="border-color: <?= $category['color']?>; box-shadow:0 0 10px <?= $category["color"]?>"></i>
                                <h5 title="<?= $name ?>"><?= strlen($name) <= 10 ? $name : substr($name, 0, 10)."..." ?></h5>
                                <h5><?= $amount ?> on due</h5>
                            </a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="colContainer">
        <div class="defaultHomepage">
            <h2>No Categories yet...</h2>
            <a href="/category/create" class="option2"><h4 class="centeredText">Add Category</h4></a>
        </div>
    </div>
    <?php
}
?>