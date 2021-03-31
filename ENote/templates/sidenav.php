<div class="sidepanel">
    <?php
    if (isset($_SESSION['creating'])) {
        unset ($_SESSION['currentCategory']);
        ?>
        <a href="/category/create" class="sidenavElement active">
            <i class="bi bi-plus-square"></i>
            <h4>New Category</h4>
        </a>
        <?php
        unset($_SESSION['creating']);
    } else {
        ?>
        <a href="/category/create" class="sidenavElement">
            <i class="bi bi-plus-square"></i>
            <h4>New Category</h4>
        </a>
        <?php
    }
    if (isset($_SESSION['showingAll'])) {
        unset ($_SESSION['currentCategory']);
        ?>
        <a href="/category" class="sidenavElement active">
            <i class="rectangle"></i>
            <h4>All Category</h4>
        </a>
        <?php
        unset($_SESSION['showingAll']);
    } else {
        ?>
        <a href="/category" class="sidenavElement">
            <i class="rectangle"></i>
            <h4>All Category</h4>
        </a>
        <?php
    }
    ?>


    <div class="sideNavScrollWidget">
        <div class="sideNavScroller">
            <?php
            if (isset($_SESSION['userCategory'])) {
                foreach ($_SESSION['userCategory'] as $category) {
                    $name = htmlentities($category['name']);
                    if (empty($_SESSION['currentCategory']) || $_SESSION['currentCategory']->id != $category['id']) {
                        $active = "";
                    } else if ($_SESSION['currentCategory']->id == $category['id']) {
                        $active = "active";
                    }
                    ?>
                    <a href="/task/?category_id=<?= $category['id'] ?>"
                       class="sidenavElement <?= $active ?>">
                        <i class="circle"
                           style="border-color: <?= $category['color'] ?>; box-shadow:0 0 10px <?= $category['color'] ?> ;"></i>
                        <h4 title="<?= $name ?>"><?= strlen($name) <= 15 ? $category['name'] : substr($name, 0, 15) . "..." ?></h4>
                    </a>
                    <?php

                }
            }

            ?>
        </div>
    </div>
</div>
