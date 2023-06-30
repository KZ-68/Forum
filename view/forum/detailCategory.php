<?php

$topicsCategory = $result["data"]['topicsCategory'];

?>

<?php

foreach($topicsCategory as $topicCategory){
?>
    <p><a href="index.php?ctrl=forum&action=detailTopic&id=<?=$topicCategory->getId()?>"><?=$topicCategory->getTitle()?></a></p>
    <p>Creation Date : <?=$topicCategory->getCreationdate()?></p>
<?php
}
?>

<button class="createTopic-btn"><a href="index.php?ctrl=forum&action=createTopic">Create Topic</a></button>

<button class="home-btn"><a href="index.php?ctrl=home&action=home.php">Return Home</a></button>