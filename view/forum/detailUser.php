<?php

$users = $result["data"]['users'];
$topics = $result["data"]['topics'];
$topicsUser = $result["data"]['topicsUser'];

?>

<img src="public/img/<?=$users->getAvatar()?>">
<p>User Name : <?=$users->getUsername()?></p>
<p>Registration Date : <?=$users->getRegistrationdate()?></p>

<p>Topics created by this user :</p>
<?php
foreach($topicsUser as $topicUser) {
?>
<p><a href="index.php?ctrl=forum&action=detailTopic&id=<?=$topicUser->getId()?>"><?=$topics->getTitle()?></a></p>
<?php
}