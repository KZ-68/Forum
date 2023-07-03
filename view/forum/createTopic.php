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
                    
                        <select name="category_id" id="category_id" required>
                        <option value="category_id" selected>Choose Category</option> 
                        <?php 
                        foreach ($category as $categories){ 
                        
                            echo "<option value = ".$categories->getId().">".$categories->getCategoryName()."</option>";

                        }
                        ?>  
                        </select>


                        <div class="title">
                            <label class="title" for="title">Title :</label>
                            <input type="text" name="title" id="title" required>
                        </div>
            
                        <div class="textTopic">
                            <label class="textTopic" for="textTopic">Text :</label>
                            <input name="textTopic" type="text" required="1" id="textTopic"/><br/>
                        </div>

                        <input type="checkbox">Confirm Captcha<br/>


                        <input id="submit" type="submit" name="createTopic" value="Create">
                    </form>

                </div>
            
            </section>
    </main>
</body>

</html>