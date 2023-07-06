<?php
    $category = $result["data"]['category'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Topic</title>
</head>
<body>
    <main>
        <section class="section_createTopic">

            <h1>Create new Topic</h1>
            
                <div class="createTopic_wrapper">

                        <form class='formular_base' action="index.php?ctrl=forum&action=createTopic" method="post">

                        <div class="title">
                            <label class="title" for="title">Title :</label>
                            <input type="text" name="title" id="title" required>
                        </div>
            
                        <div class="text">
                            <label class="text" for="text">Text :</label>
                            <input name="text" type="text" required="1" id="text"/><br/>
                        </div>

                        <input type="checkbox">Confirm Captcha<br/>

                        <input type="hidden" name="category_id" value="<?=$category->getId()?>">
                        

                        <input id="submit" type="submit" name="createTopic" value="Create">
                    </form>

                </div>
            
            </section>
    </main>
</body>

</html>