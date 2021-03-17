<head>
    <link rel="stylesheet" href="/css/sidepanel.css">
</head>
<body>
    <div class="sidepanel">
        <a href="/category/create">New Category</a>
        <a href="/">All Category</a>
        <?php
        if (isset($_SESSION['userCategory'])) {
            foreach ($_SESSION['userCategory'] as $category) {
                echo '<a href="/task/create">'.$category['name'].'</a>';
            }
        }
        ?>
    </div>

</body>

