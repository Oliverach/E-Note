<div class="doubleColContainer">
    <div class="wrapper2">
        <div class="row">
            <div class="scrollWrapper">
                <h2>Due Today</h2>
                <div class="scroller">
                    <?php
                    if (isset($_SESSION['taskOfCurrentDay'])) {
                        foreach ($_SESSION['taskOfCurrentDay'] as $task) {
                            ?>
                                <a href="/task/complete?id=<?= $task['id'] ?>" class="task"><?= $task['description'] ?></a>
                            <?php
                        }
                    } else {
                        ?>
                        <p>Nothing due today^^</p>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="scrollWrapper">
                <h2>Due Tomorrow</h2>
                <div class="scroller">

                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="scrollWrapper3">
            <div class="scroller3">
                <?php
                if (isset($_SESSION['taskAmountByCategory'])) {
                    foreach ($_SESSION['taskAmountByCategory'] as $task) {
                        ?>
                        <div class="categoryContainer">
                            <p><?= $task['name'] ?></p>
                            <p><?= $task['amount'] ?> on due</p>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <p>No Category yet</p>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>

</div>