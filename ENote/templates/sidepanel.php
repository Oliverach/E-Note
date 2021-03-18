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
                echo '<form action="/task/create" method="POST"><button type="submit" name="id" value="'.$category['id'].'">'.$category['name'].'</button></form>';
            }
        }
        ?>

    </div>

</body>

