<?php

$topicsCategory = $result["data"]['topicsCategory'];
$category = $result["data"]['category'];

?>

<?php

foreach($topicsCategory as $topicCategory){
?>
    <p>
        <a href="index.php?ctrl=forum&action=detailTopic&id=<?=$topicCategory->getId()?>"><?=$topicCategory->getTitle()?></a>
        <form action="index.php?ctrl=forum&action=deleteTopic&id=<?=$topicCategory->getId()?>" method="post">
            <input type="submit" name="deleteTopic" value="Delete Topic">
        </form>
    </p>
    <p>Creation Date : <?=$topicCategory->getCreationdate()?></p>
<?php
}
?>

<button class="createTopic-btn"><a href="index.php?ctrl=forum&action=createTopicForm&id=<?=$category->getId()?>">Create Topic</a></button>

<button class="backTo-btn"><a href="index.php?ctrl=forum&action=categoriesList">Back to the Categories</a></button>
<button class="home-btn"><a href="index.php?ctrl=home&action=home.php">Return Home</a></button>