<?php
    $topic = $result["data"]['topic'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Topic</title>
</head>
<body>
    <main>
        <section class="section_updateTopic">

            <h1>Modify this Topic</h1>
            
                <div class="updateTopic_wrapper">

                        <form class='formular_base' action="index.php?ctrl=forum&action=updateTopic&id=<?=$topic->getId()?>" method="post">

                        <div class="title">
                            <label class="title" for="title">Title :</label>
                            <input type="text" name="title" id="title" required>
                        </div>
            
                        <div class="text">
                            <label class="text" for="text">Text :</label><br/>
                            <textarea id="text" name="text" rows="5" cols="50"></textarea>
                        </div>

                        <input type="checkbox">Confirm Captcha<br/>
                        
                        <input id="submit" type="submit" name="updateTopic" value="Modify Topic">
                    </form>

                </div>
            
            </section>
    </main>
</body>

</html>