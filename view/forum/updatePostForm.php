<?php
    $post = $result["data"]['post'];
    $topic = $result["data"]['topic'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Post</title>
</head>
<body>
    <main>
        <section class="section_updatePost">

            <h1>Modify this post</h1>
            
                <div class="updatePost_wrapper">

                    <form class='formular_base' action="index.php?ctrl=forum&action=updatePost&id=<?=$post->getId()?>" method="post">

                    <label for="text">Text: </label><br/>
                    <textarea id="text" name="text" rows="5" cols="50"></textarea>

                    <input id="submitPost" type="submit" name="createPost" value="Modify Post">
                    </form>

                </div>
            
            </section>
            <button class="backTo-btn"><a href="index.php?ctrl=forum&action=detailTopic&id=<?=$topic->getId()?>">Back to the Topic</a></button> 
    </main>
</body>

</html>