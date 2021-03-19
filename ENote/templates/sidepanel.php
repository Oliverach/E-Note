<div class="sidepanel">

    <a href="/category/create" class="sidenavA">
        <div class="sidenavElement">
            <p>New Category</p>
        </div>
    </a>
    <a href="/category/showAll" class="sidenavA">
        <div class="sidenavElement">
            <p>All Category</p>
        </div>
    </a>
    <?php
    if (isset($_SESSION['userCategory'])) {
        foreach ($_SESSION['userCategory'] as $category) {
            ?>
            <a href="/task/create?id=<?= $category['id'] ?>&name=<?= $category['name'] ?>"
               class="sidenavA"><?= $category['name'] ?></a>
            <?php
        }
    }
    ?>
</div>

