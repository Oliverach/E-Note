<head>
    <link rel="stylesheet" href="/css/sidepanel.css">
</head>
<body>
    <div class="sidepanel">

        <a href="/category/create" >New Category</a>
        <a href="/">All Category</a>
        <?php
        if (isset($_SESSION['userCategory'])) {
            foreach ($_SESSION['userCategory'] as $category) {
           ?>
                <a href="/task/create?id=<?= $category['id'] ?>"><?= $category['name'] ?></a>
            <?php
            }
        }
        ?>
    </div>
</body>

