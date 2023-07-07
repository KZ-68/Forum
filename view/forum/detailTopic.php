<?php

$user = $result["data"]['user'];
$topics = $result["data"]['topics'];
$postsUser = $result["data"]['postsUser'];


?>
<a href="index.php?ctrl=forum&action=updateTopicForm&id=<?=$topics->getId()?>">Modify the Topic</a>
<?php
foreach($postsUser as $postUser){
?>
    <a href="index.php?ctrl=forum&action=updatePostForm&id=<?=$postUser->getId()?>">Modify the post</a>
    <div class="topic-posts">
    <h3><?=$topics->getTitle()?></h3> 
    <p>
    <img class="post-avatar" src="public/img/<?=$postUser->getUser()->getAvatar()?>">
        <a href="index.php?ctrl=forum&action=detailUser&id=<?=$postUser->getUser()->getId()?>"><?=$postUser->getUser()->getUsername()?></a>
    </p>
    <p><?=$postUser->getText()?></p>
    <p><?=$postUser->getCreationdate()?></p>
    </div>
    <form action="index.php?ctrl=forum&action=deletePost&id=<?=$postUser->getId()?>" method="post">
    <input type="submit" name="deletePost" value="Delete Post">
    </form>
    <?=var_dump($postUser->getId())?>
<?php
}
?>

<div class="postsArea">
<h4>Add a new post</h4>
<form id="postsForm" action="index.php?ctrl=forum&action=createPost&id=<?=$topics->getId()?>" method="post">
<label for="text">Text: </label><br/>
<textarea id="text" name="text" rows="5" cols="50"></textarea>

<input type="hidden" id="topic_id" name="topic_id" value="<?=$topics->getId()?>">
<input id="submitPost" type="submit" name="createPost" value="Add new post">
</form>
</div>

<button class="home-btn"><a href="index.php?ctrl=home&action=home.php">Return Home</a></button>