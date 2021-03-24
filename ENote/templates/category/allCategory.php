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
                            ?>
                            <a href="/task/complete?id=<?= $task['id'] ?>" class="taskContainer">
                                <div class="circle"></div>
                                <h5><?= $task['description'] ?></h5>
                            </a>
                            <?php
                        }
                    } else {
                        ?>
                        <h5 class="centeredText">Nothing due today^^</h5>
                        <?php
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
                            ?>
                            <a href="/task/complete?id=<?= $task['id'] ?>" class="taskContainer">
                                <div class="circle"></div>
                                <h5><?= $task['description'] ?></h5>
                            </a>
                            <?php
                        }
                    } else {
                        ?>
                        <h5 class="centeredText">Nothing due tomorrow^^</h5>
                        <?php
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
                        foreach ($_SESSION['taskAmountByCategory'] as $task) {
                            ?>
                            <div class="categoryContainer">
                                <div class="circle"></div>
                                <h5><?= $task['name'] ?></h5>
                                <h5><?= $task['amount'] ?> on due</h5>
                            </div>
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