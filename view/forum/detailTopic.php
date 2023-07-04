<?php

$user = $result["data"]['user'];
$topics = $result["data"]['topics'];
$posts = $result["data"]['posts'];

?>

<section class="topic-author">
<p><a href="index.php?ctrl=forum&action=detailUser&id=<?=$user->getId()?>"><?=$user->getUsername()?></a></p>
<h1><?=$topics->getTitle()?></h1> 
<p><?=$topics->getTextTopic()?></p>
</section>

<?php
foreach($posts as $post){
?>
    <div class="topic-posts">
    <p><a href="index.php?ctrl=forum&action=detailUser&id=<?=$post->getUser()->getId()?>"><?=$post->getUser()->getUsername()?></a></p>
    <p><?=$post->getText()?></p>
    <p><?=$post->getCreationdate()?></p>
    </div>
<?php
}
?>

<form action="index.php?ctrl=forum&action=createPost&id=<?=$topics->getId()?>" method="post">
<label for="text">Text: </label><br/>
<textarea id="text" name="text" rows="5" cols="50"></textarea>

<input type="hidden" id="topic_id" name="topic_id" value="<?=$topics->getId()?>">
<input id="submit" type="submit" name="createPost" value="Add new post">
</form>

<button class="home-btn"><a href="index.php?ctrl=home&action=home.php">Return Home</a></button>