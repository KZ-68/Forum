<?php

$topics = $result["data"]['topics'];

?>

<?php

foreach($topics as $topic){
?>
<p><a href="index.php?ctrl=forum&action=detailTopic&id=<?=$topic->getId()?>"><?=$topic->getTitle()?></a></p>
<p>Creation Date : <?=$topic->getCreationdate()?></p>
<?php
}

