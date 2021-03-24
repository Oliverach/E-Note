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
        <a href="/category/showAll" class="sidenavElement active">
            <div class="rectangle"></div>
            <h4>All Category</h4>
        </a>
        <?php
        unset($_SESSION['showingAll']);
    } else {
        ?>
        <a href="/category/showAll" class="sidenavElement">
            <div class="rectangle"></div>
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
                    if(empty($_SESSION['currentCategory']->id)){
                        $active = "";
                    }else if($_SESSION['currentCategory']->id == $category['id']){
                        $active = "active";
                    }
                    ?>
                    <a href="/task/create?id=<?= $category['id'] ?>"
                       class="sidenavElement <?= $active ?>">
                        <i class="circle" style="border-color: <?= $category['color'] ?>; box-shadow:0 0 10px <?= $category['color'] ?> ;"></i>
                        <h4><?= $category['name'] ?></h4>
                    </a>
                    <?php

                }
            }
            ?>
        </div>
    </div>
</div>

