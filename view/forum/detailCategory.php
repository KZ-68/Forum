<?php

$topics = $result["data"]['topics'];
$topicsCategory = $result["data"]['topicsCategory'];

?>

<?php

foreach($topicsCategory as $topicCategory){
?>
<p><a href="index.php?ctrl=forum&action=detailTopic&id=<?=$topicCategory->getId()?>"><?=$topicCategory->getTitle()?></a></p>
<p>Creation Date : <?=$topicCategory->getCreationdate()?></p>
<?php
}

