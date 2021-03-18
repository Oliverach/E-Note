<head>
    <link rel="stylesheet" href="/css/layout.css">
</head>
<body>
<div class="specificCategory">
    <div class="wrapper2">
        <form action="/task/addTask" method="POST" class="wrapper3r">
            <input type="text" placeholder="Task Description" name="description" required>
            <input type="date" name="date" required>
            <input type="submit" value="Create">
        </form>
        <div class="completed">
            <?php
            if (isset($_SESSION['completedTaskOfCurrentCategory'])) {
                foreach ($_SESSION['completedTaskOfCurrentCategory'] as $completedTask) {
                    ?>
                    <a href="/task/complete?id=<?= $completedTask['id'] ?>"><?= $completedTask['description'] ?></a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <div class="">
        <?php
        if (isset($_SESSION['taskOfCurrentCategory'])) {
            foreach ($_SESSION['taskOfCurrentCategory'] as $task) {
                ?>
                <a href="/task/complete?id=<?= $task['id'] ?>"><?= $task['description'] ?></a>
                <?php
            }
        }
        ?>
    </div>
</div>
</body>