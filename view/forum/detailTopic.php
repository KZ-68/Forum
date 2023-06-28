<?php

$user = $result["data"]['user'];
$userPosts = $result["data"]['userPosts'];
$topics = $result["data"]['topics'];
$posts = $result["data"]['posts'];

?>

<section class="topic-author">
<p><?=$user->getUsername()?></p>
<h1><?=$topics->getTitle()?></h1> 
<p><?=$topics->getTextTopic()?></p>
</section>

<?php
foreach($posts as $post){

?>
<div class="topic-posts">
<p><?=$userPosts->getUsername()?></p>
<p><?=$post->getText()?></p>
</div>
<?php
}