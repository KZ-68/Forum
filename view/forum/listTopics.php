<?php

$topics = $result["data"]['topics'];
    
?>

<h1>List topics</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><?=$topic->getTitle()?></p>
    <p>Creation Date : <?=$topic->getCreationdate()?></p>
    <?php
}


  
