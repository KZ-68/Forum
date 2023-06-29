<?php

$user = $result["data"]['user'];
$userPosts = $result["data"]['userPosts'];
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
<p><a href="index.php?ctrl=forum&action=detailUser&id=<?=$post->getId()?>"><?=$userPosts->getUsername()?></a></p>
<p><?=$post->getText()?></p>
</div>
<?php
}