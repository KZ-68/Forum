<?php
$topics = $result["data"]['topics'];
$categories = $result["data"]['categories'];
?>

<div id="home-wrapper">
<h1>Welcome to the forum !</h1>

<p id="home-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>

<?php
if (App\Session::getUser()) {
?>
    <h2>Most recent Topics</h2>
    <div id="new-topics">
        <?php
        foreach ($topics as $topic) {
        ?>
            <div class="new-topics-wrapper">
            <a href="index.php?ctrl=forum&action=detailTopic&id=<?=$topic->getId()?>"><?=$topic->getTitle()?></a><span id="new-topics-date">Creation Date : <?=$topic->getCreationdate()?></span><br/>
            </div>
        <?php
        }
        ?>
    </div>
    <h2>Categories List</h1>
<?php
    foreach($categories as $category){
?>
    <p>
        <a class='categories-links' href="index.php?ctrl=forum&action=detailCategory&id=<?=$category->getId()?>"><?=$category->getCategoryName()?></a>
    </p>
<?php
}
?> 
<?php
} else {
?>
    <p id="access">
    <a href="index.php?ctrl=security&action=loginForm">Se connecter</a>
    <span>&nbsp;&nbsp;</span>
    <a href="index.php?ctrl=security&action=registerForm">S'inscrire</a>
</p>
<?php
}
?>

</div>