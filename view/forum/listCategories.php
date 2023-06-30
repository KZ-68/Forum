<?php

$categories = $result["data"]['categories'];
    
?>

<h1>List Categories</h1>

<?php
foreach($categories as $category){
?>
    <p><a class='links' href="index.php?ctrl=forum&action=detailCategory&id=<?=$category->getId()?>"><?=$category->getCategoryName()?></a></p>
<?php
}
?>

<button class="home-btn"><a href="index.php?ctrl=home&action=home.php">Return Home</a></button>