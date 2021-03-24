<div class="colContainer">
    <form action="/category/doCreate" method="POST" class="widget1">
        <h2>New Category</h2>
        <div class="layout3">
            <div class="iconInputContainer">
                <i class="bi bi-plus-square addView"></i>
                <input type="text" placeholder="Category Name" name="name" required>
            </div>

            <div class="colorpicker">
                <h5>Select Color:</h5>
                <input type="color" name="color"value="#00ff00"required>
            </div>
            <input type="submit" value="Create">
        </div>
    </form>
</div>
