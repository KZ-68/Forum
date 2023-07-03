<?php

$users = $result["data"]['users'];
$topicsUser = $result["data"]['topicsUser'];
$postsUser = $result["data"]['postsUser'];

?>

<img src="public/img/<?=$users->getAvatar()?>">
<form action="index.php?ctrl=forum&action=changeAvatar" method="post" enctype="multipart/form-data">
<label>Change Avatar: </label><br/>
<input type="file">
<input id="submit" type="submit" name="changeAvatar" value="Confirm">
</form>

<p>User Name : <?=$users->getUsername()?></p>
<p>Registration Date : <?=$users->getRegistrationdate()?></p>

<p>Topics created by this user :</p>

<?php
foreach($topicsUser as $topicUser) {
?>
    <p><a href="index.php?ctrl=forum&action=detailTopic&id=<?=$topicUser->getId()?>"><?=$topicUser->getTitle()?></a></p>
<?php
}
?>

<p>Posts created by this user :</p>

<?php
foreach($postsUser as $postUser) {
?>
    <p><a href="index.php?ctrl=forum&action=detailTopic&id=<?=$postUser->getTopic()->getId()?>"><?=$postUser->getText()?></a></p>
<?php
}
?>

<button class="home-btn"><a href="index.php?ctrl=home&action=home.php">Return Home</a></button>