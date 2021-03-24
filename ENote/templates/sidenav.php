<div class="sidepanel">
    <a href="/category/create" class="sidenavElement">
        <i class="bi bi-plus-square"></i>
        <h4>New Category</h4>
    </a>
    <a href="/category/showAll" class="sidenavElement">
        <div class="rectangle"></div>
        <h4>All Category</h4>
    </a>
    <div class="sideNavScrollWidget">
        <div class="sideNavScroller">
            <?php
            if (isset($_SESSION['userCategory'])) {
                foreach ($_SESSION['userCategory'] as $category) {
                    ?>
                    <a href="/task/create?id=<?= $category['id'] ?>&name=<?= $category['name'] ?>" class="sidenavElement <?= $category['name'] ?>" onclick="displayStatus()">
                        <div class="circle"></div>
                        <h4><?= $category['name'] ?></h4>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>

