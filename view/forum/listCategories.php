<?php

$categories = $result["data"]['categories'];
    
?>

<button class="createCategory-btn"><a href="index.php?ctrl=forum&action=createCategoryForm">Create Category</a></button>

<h1>List Categories</h1>

<?php
foreach($categories as $category){
?>
    <p>
        <a class='links' href="index.php?ctrl=forum&action=detailCategory&id=<?=$category->getId()?>"><?=$category->getCategoryName()?></a>
        <form action="index.php?ctrl=forum&action=deleteCategory&id=<?=$category->getId()?>" method="post">
            <input type="submit" name="deleteCategory" value="Delete Category">
        </form>
        <button class="updateCategory-btn"><a href="index.php?ctrl=forum&action=updateCategoryForm&id=<?=$category->getId()?>">Modify Category</a></button>
    </p>
<?php
}
?>

<button class="home-btn"><a href="index.php?ctrl=home&action=home.php">Return Home</a></button>